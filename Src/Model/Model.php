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
 *  Base implementation inherited by all models.
 */

abstract class Model
{
    protected $database;
    protected $tableName;

    private $viewContext;
    private $tableDefinition;

    // If overridden, call this before changing any default values
    public function __construct($tableName)
    {
        if (!is_string($tableName)) { throw new BadMethodCallException('$tableName must be a string'); }
        
        $this->tableName = $tableName;
        $this->viewContext = default_view_context();

        // database singleton
        global $useTestDatabase, $dbTestConnArgs;
        static $db = NULL;
        if ($db === NULL) { $db = new Database(); }
        $this->database = $db;
    }

    // Set a variable to make it available in the view
    final public function set($name, $value)
    {
        $this->viewContext[$name] = $value;
    }

    // Get a variable created with "set()"
    final public function get($name)
    {
        return $this->viewContext[$name];
    }

    final public function getFieldNames() { return array_keys($this->tableDefinition); }
    final public function getViewContext() { return $this->viewContext; }

    final public function read(array $fieldNames = array())
    {
        $this->set('data', $this->database->select($this->tableName, $fieldNames));
        $this->_setDatabaseDebugInfo();
    }

    final public function readById($id) // select an item with a particular id
    {
        $result = $this->database->select($this->tableName, array(), array(), "WHERE id=$id");
        $this->set('data', $result);
        $this->_setDatabaseDebugInfo();
        return $result;
    }

    final public function readByCondition($condition) // select an item based on a particular condition
    {
        $result = $this->database->select($this->tableName, array(), array(), "WHERE $condition");
        $this->set('data', $result);
        $this->_setDatabaseDebugInfo();
        return $result;
    }

    final public function join(array $fieldNames = array(), array $joins = array())
    {
        // Takes an array of JoinArguments objects to define a series of INNER JOIN statements
        $this->set('data', $this->database->read($this->tableName, $fieldNames, $joins));
        $this->_setDatabaseDebugInfo();
    }

    //final public function create(array $fieldValueAssoc)
    //{
    //    $this->_throwOnNonExistentTableOrFieldName(array_keys($fieldValueAssoc));
    //    $this->data = $database->create($this->tableName, $fieldValueAssoc);
    //}

    private function _setDatabaseDebugInfo()
    {
        if (DEBUG_ENABLED) {
            $this->set('debug_sql', $this->database->sql);
            $this->set('debug_data_errno', $this->database->errno);
            $this->set('debug_data_error', $this->database->error);
        }
    }

    //private function _throwOnNonExistentTableOrFieldName(array $fieldNames, $table = '')
    //{
    //    // Make sure we're only referring to table/row names we've explicitely defined in code
    //    if (!$table) { $table = $this->tableName; }

    //    if (!$tableDef = Schema::definition($table)) {
    //        throw new BadMethodCallException(
    //                    "Unknown table ($table) does not exist in schema");
    //    }

    //    if ($fieldNames) {
    //        foreach ($fieldNames as $name) {
    //            if (!array_key_exists($name, $tableDef)) {
    //                throw new BadMethodCallException(
    //                    "Unknown field name ($name) does not exist in table $table's definition.");
    //            }
    //        }
    //    }
    //}
}
?>