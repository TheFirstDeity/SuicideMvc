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
 *  Arguments used by Database.php for INNER JOINs on tables.
 */

class JoinArguments
{
    public $foreignTable;
    public $fieldNames;
    public $primaryKeyName;
    public $foreignKeyName;
    public $foreignAliasPrefix;
    public $thirdDegreeTable; // IGNORED, UNIMPLEMENTED

    public function __construct($foreignTable, array $fieldNames, $primaryKeyName = '', $foreignKeyName = '', $foreignAliasPrefix = '', $thirdDegreeTable = '')
    {
        if (!$foreignTable || !is_string($foreignTable)) { throw new BadMethodCallException('$foreignTable must be a non-empty string'); }
        if (!$fieldNames) { throw new BadMethodCallException('$fieldNames cannot be an empty array'); }

        $this->foreignTable = $foreignTable;
        $this->fieldNames = $fieldNames;

        // Defaults
        $this->primaryKeyName = $primaryKeyName ? $primaryKeyName : 'id';
        $this->foreignKeyName = $foreignKeyName ? $foreignKeyName : ($foreignTable . '_id');
        $this->foreignAliasPrefix = $foreignAliasPrefix;
        $this->thirdDegreeTable = $thirdDegreeTable;
    }
}

?>