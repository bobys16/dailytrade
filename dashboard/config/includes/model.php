<?php
class Bcrypt
{
    private $rounds;

    public function __construct($rounds = 12)
    {
        if (CRYPT_BLOWFISH != 1) {
            throw new Exception("bcrypt not supported in this installation. See http://php.net/crypt");
        }

        $this->rounds = $rounds;
    }

    public function hash($input)
    {
        $hash = crypt($input, $this->getSalt());

        if (strlen($hash) > 13) {
            return $hash;
        }
        return false;
    }

    public function verify($input, $existingHash)
    {
        $hash = crypt($input, $existingHash);

        return $hash === $existingHash;
    }

    private function getSalt()
    {
        $salt = sprintf('$2a$%02d$', $this->rounds);

        $bytes = $this->getRandomBytes(16);

        $salt .= $this->encodeBytes($bytes);

        return $salt;
    }
}

function time_elapsed_string($timenya, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($timenya);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

class Model
{
    public function db_query($db, $select, $table, $where = null, $limit = '')
    {
        $query = mysqli_query($db, "SELECT " . $select . " FROM " . $table . " " . $limit);
        if ($where <> null) {
            $query = mysqli_query($db, "SELECT " . $select . " FROM " . $table . " WHERE " . $where . " " . $limit);
        }
        if (mysqli_error($db)) {
            return false;
        } else {
            if (mysqli_num_rows($query) == 1) {
                $rows = mysqli_fetch_assoc($query);
            } else {
                $rows = [];
                while ($row = mysqli_fetch_assoc($query)) {
                    $rows[] = $row;
                }
            }
            $result = array('query' => $query, 'rows' => $rows, 'count' => mysqli_num_rows($query));
            return $result;
        }
    }

    public function db_query_join($db, $select, $table, $join, $where = null, $limit = '')
    {
        $query = mysqli_query($db, "SELECT " . $select . " FROM " . $table . " " . $join . " " . $limit);
        if ($where <> null) {
            $query = mysqli_query($db, "SELECT " . $select . " FROM " . $table . " " . $join . " WHERE " . $where . " " . $limit);
        }
        if (mysqli_error($db)) {
            return false;
        } else {
            if (mysqli_num_rows($query) == 1) {
                $rows = mysqli_fetch_assoc($query);
            } else {
                $rows = [];
                while ($row = mysqli_fetch_assoc($query)) {
                    $rows[] = $row;
                }
            }
            $result = array('query' => $query, 'rows' => $rows, 'count' => mysqli_num_rows($query));
            return $result;
        }
    }
    public function db_insert($db, $table, $data)
    {
        if (!is_array($data)) {
            return false;
        } else {
            $query = mysqli_query($db, "INSERT INTO $table (" . implode(', ', array_keys($data)) . ") VALUES ('" . implode('\', \'', $data) . "')");
            if (mysqli_error($db)) {
                return false;
            } else {
                return mysqli_insert_id($db);
            }
        }
    }
    public function db_update($db, $table, $data, $where)
    {
        if (!is_array($data)) {
            return false;
        } else {
            $update = "";
            $count = count($data);
            $i = 1;
            foreach ($data as $k => $v) {
                if ($i == $count) {
                    $update .= $k . " = '" . $v . "'";
                } else {
                    $update .= $k . " = '" . $v . "', ";
                }
                $i++;
            }
            $query = mysqli_query($db, "UPDATE $table SET $update WHERE $where");
            if (mysqli_error($db)) {
                return false;
            } else {
                return true;
            }
        }
    }
    public function db_delete($db, $table, $where)
    {
        $query = mysqli_query($db, "DELETE FROM $table WHERE $where");
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Upload version 1.0
 * Created by HackerRahul http://HackerRahul.com
 * Date 24 august 2015
 */
class Upload
{

    // make variables of parameters
    private $_upload,
        $_dir,
        $_size,
        $_allowed,
        $_result = array();

    function __construct($upload = array(), $dir, $size, $allowed)
    {
        // set the paramters equal to the member variable of the upload class
        $this->_upload = $upload;
        $this->_dir = $dir;
        $this->_size = $size;
        $this->_allowed = $allowed;

        // call the upload method and upload the file braaaaaaaa
        $this->Upload();
    }

    // METHOD TO UPLOAD FILE
    private function Upload()
    {
        // check weather paramters are empty
        if (!empty($this->_upload) && (!empty($this->_dir)) && (!empty($this->_size)) && (!empty($this->_allowed))) {
            // check $_upload & $_allowed is an array
            if ((is_array($this->_upload)) && (is_array($this->_allowed))) {
                // get the extension of the uploaded file
                $explode = explode(".", strtolower($this->_upload['name']));
                $key = count($explode) - 1;
                $extension = $explode[$key];
                // check extension is allowed
                if (in_array($extension, $this->_allowed)) {
                    // check size
                    if ($this->_upload['size'] < $this->_size) {
                        // upload the file
                        $filename = $this->_upload['name'];
                        $tmpname = $this->_upload['tmp_name'];
                        if (move_uploaded_file($tmpname, $this->_dir . $filename)) {
                            $this->_result['type'] = "success";
                            $this->_result['message'] = "File Has been uploaded";
                            $this->_result['path'] = $this->_dir . $filename;
                        } else {
                            $this->_result['type'] = "error";
                            $this->_result['message'] = "Error in uploading file";
                            $this->_result['path'] = false;
                        }
                    } else {
                        $this->_result['type'] = "error";
                        $this->_result['message'] = "Fill should be less then {$this->_size} BYTES";
                        $this->_result['path'] = false;
                    }
                } else {
                    $this->_result['type'] = "error";
                    $this->_result['message'] = "Fill Type not allowed";
                    $this->_result['path'] = false;
                }
            } else {
                $this->_result['type'] = "error";
                $this->_result['message'] = "Parameters 1st and 4th should be an array";
                $this->_result['path'] = false;
            }
        } else {
            $this->_result['type'] = "error";
            $this->_result['message'] = "Parameters can not be empty";
            $this->_result['path'] = false;
        }
    }

    // METHOD TO RETURN RESULT
    public function GetResult()
    {
        return $this->_result;
    }
}
