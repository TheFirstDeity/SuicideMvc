<?php
/**
 *  ====== COPYRIGHT ======
 *  Suicide MVC, A Simple RAD Framework
 *  Copyright (c) Devin Ireland, http://devinireland.com
 *
 *  Licensed under The Microsoft Public License
 *  See LICENSE-SMVC.txt in the root folder of this source code.
 *  Redistributions of files must retain this copyright notice.
 *  =======================
 *  
 *  ----- File Description -----
 *  Some generic database functions for connecting to a MySql database
 *  and building SQL statements to query it.
 */

class Database
{
    public $errno = NULL;  // connect/query errno from mysqli
    public $error = NULL;  // connect/query error from mysqli
    public $sql = NULL;    // SQL from last executed query

    //private $table = NULL;


    public function __construct(array $connArgs = array())
    {
        global $dbConnArgs, $dbTestConnArgs;
        if (!$connArgs) {
            $connArgs = USE_TEST_DATABASE ? $dbTestConnArgs : $dbConnArgs;
        }

        while(list($name, $value) = each($connArgs)) {
            $this->{$name} = $value;
        }
    }

    // TEMPORARY ------------------------------------------------------
    // We can use this for now to conveniently connect to the same DB (globals.php)
    // because there's serious code duplication everywhere.
    public function InitMysqli() { return $this->_initConnection(); }

    // PUBLIC METHODS -------------------------------------------------
    public function select($table, array $fieldNames = array(), array $joinArguments = array(), $where = '')
    {
        // I'm simply taking the WHERE/ORDERBY as a string for now, this will have to be upgraded at some point
        if (!$table || !is_string($table)) { throw new BadMethodCallException('$table must be a non-empty string'); }

        if (!$fieldNames && !$joinArguments) {
            $this->sql = "SELECT * FROM $table $where"; // shortcut
        } else {
            $fieldAliasAssoc = $this->_createQualifiedFieldAssoc($table, $fieldNames);
            $innerJoinStack = array();
            foreach ($joinArguments as $join) {
                $fieldAliasAssoc += $this->_createQualifiedFieldAssoc($join->foreignTable, $join->fieldNames, TRUE);
                array_push($innerJoinStack, "INNER JOIN $join->foreignTable ON $table.$join->foreignKeyName = $join->foreignTable.$join->primaryKeyName");

                // Attempt to map fields that are a degree of separation away

                //if ($join->thirdDegreeTable = $thirdDegreeTable) {
                //    array_push($innerJoinStack, "INNER JOIN $join->thirdDegreeTable ON $join->foreignTable.$join->foreignKeyName = $join->thirdDegreeTable.$join->primaryKeyName");
                //} else {
                //    array_push($innerJoinStack, "INNER JOIN $join->foreignTable ON $table.$join->foreignKeyName = $join->foreignTable.$join->primaryKeyName");
                //}
            }

            $selectStack = array(); 
            foreach ($fieldAliasAssoc as $field => $alias) {
                array_push($selectStack, "$field AS $alias");
            }

            $this->sql = 'SELECT ' . implode(', ', $selectStack) . ' FROM ' . $table . ' ' . implode(' ', $innerJoinStack) . ' ' . $where;
        }

        $result = $this->_query();
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return NULL;
    }

    public function create($table, array $fieldNames, array $values)
    {
        if (!$table || !is_string($table)) { throw new BadMethodCallException('$table must be a non-empty string'); }


        $values = array_map(function($v) { return strpos($v, ' ') === FALSE ? $v : "'$v'"; }, $values);
        $this->sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fieldNames) . ') VALUES(' . implode(', ', $values) . ')';
        return $this->sql;
        //return $this->_query();
    }

    // PRIVATE METHODS -------------------------------------------------
    private function _query()
    {
        // executes whatever's in $this->sql, retuns result, or NULL on error

        $conn = $this->_initConnection();
        if ($this->errno) { return NULL; }

        if (!($result = $conn->query($this->sql))) {
            $this->errno = $conn->errno;
            $this->error = $conn->error;
            return NULL;
        }

        $conn->close();
        return $result;
    }

    private function _initConnection()
    {
        // return new mysqli($this->host, $this->login, $this->password, $this->database);
        $mysqli = new mysqli();

        if (isset($this->sslKeyFile) && isset($this->sslCertFile) && isset($this->sslCaFile)) {
            $mysqli->ssl_set($this->sslKeyFile, $this->sslCertFile, $this->sslCaFile, null, null);
        }
        
        if (!$mysqli->real_connect($this->host, $this->login, $this->password, $this->database)) {
            $this->errno = $mysqli->connect_errno;
            $this->error = $mysqli->connect_error;
        }
        return $mysqli;
    }

    // returns array('table.field' => 'table_field')
    private function _createQualifiedFieldAssoc($table, array $fieldNames, $alias = FALSE, $aliasPrefix = '')
    {
        // default prefix is the table name, or nothing if it's disabled
        if (!$alias) {
            $aliasPrefix = '';
        } else {
            $aliasPrefix = $aliasPrefix ? $aliasPrefix : $table . '_';
        }

        $result = array();
        foreach($fieldNames as $field) {
            $fieldName = $table . '.' . $field;
            $aliasName = $aliasPrefix . $field;
            $result[$fieldName] = $aliasName;
        }
        return $result;
    }
}
?>