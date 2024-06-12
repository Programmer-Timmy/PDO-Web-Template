<?php
namespace App\Controllers\GlobalUtility;

/**
 * A custom button class for the table
 * 
 * @property string $class The classes to apply to the button
 * @property string $action The URL to redirect to
 * @property string $label The text to display on the button
 */
class CustomButton{
    public string $class;
    public string $action;
    public string $label;

    /**
     * @param string $action The URL to redirect to
     * @param string $label The text to display on the button
     * @param string $class The classes to apply to the button
     *  
     * @return void
     */
    public function __construct(string $action, string $label, string $class = 'btn btn-primary'){
        $this->class = $class;
        $this->action = $action;
        $this->label = $label;
    }
}


/**
 * Settings for the table
 * 
 * @property array $shownTables The columns that will be shown in the table. Use '*' for all columns.
 * @property CustomButton[] $customButtons The custom buttons that will be shown in the table. If empty, no buttons will be shown.
 * @property bool $bootstrap Whether to use Bootstrap classes for the table.
 * 
 */
class TableSettings{
    public array $shownTables = ['*'];
    public array $customButtons = [];
    public bool $bootstrap;

    /**
     * @param array $shownTables The columns that will be shown in the table. Use '*' for all columns.
     * @param CustomButton[] $customButtons The custom buttons that will be shown in the table. If empty, no buttons will be shown. Use the customButton class.
     * @param bool $bootstrap Whether to use Bootstrap classes for the table.
     * 
     * @return void
     */
    public function __construct(array $shownTables = ['*'], array $customButtons = [], bool $bootstrap = true){
        $this->shownTables = $shownTables;
        $this->customButtons = $customButtons;
        $this->bootstrap = $bootstrap;
    }
}

/**
 * A table class
 * 
 * @property array $table The data to display in the table
 * @property TableSettings $tableSettings The settings for the table
 */
class TableUtility{
    private array $table;
    private TableSettings $tableSettings;

    /**
     * @param array $data The data to display in the table. This should be a array whit objects.
     * 
     * @return void
     */
    public function __construct(array $data){
        if (empty($data)) {
            throw new \Exception('Data cannot be empty');
        }

        $this->table = $data;  
        $this->tableSettings = new TableSettings();  
    }

    /**
     * This function generates the headers for the table
     * 
     * @return string The headers for the table
     */
    private function generateHeaders(): string{
        $table = $this->tableSettings->bootstrap ? '<thead class="table-dark">' : '<thead>';
        if (!empty($this->table)) {
            // Loop through the columns
            foreach (get_object_vars($this->table[0]) as $column => $value) {

                // Check if the column should be shown
                if ($this->tableSettings->shownTables[0] == '*') {
                    $table .= '<th>' . $column . '</th>';
                } else {

                    // Check if the column should be shown
                    if (in_array($column, $this->tableSettings->shownTables)) {
                        $table .= '<th>' . ucfirst($column) . '</th>';
                    }
                }
                
            }

            // Add the custom buttons
            if (!empty($this->tableSettings->customButtons)) {
                foreach ($this->tableSettings->customButtons as $button) {
                    $table .= '<th></th>';
                }
            }
        }
        
        $table .= '</tr></thead>';
        return $table;
    }

    /**
     * This function generates the rows for the table
     *
     * @return string The rows for the table
     */
    private function generateRows(): string{
        $table = '<tbody>';
        foreach ($this->table as $row) {
            $table .= '<tr>';

            // Loop through the columns
            foreach (get_object_vars($row) as $column => $value) {
                // Check if all the column should be shown
                if ($this->tableSettings->shownTables[0] == '*') {
                    $table .= '<td>' . $value . '</td>';
                } else {

                    // Check if the column should be shown
                    if (in_array($column, $this->tableSettings->shownTables)) {
                        $table .= '<td>' . $value . '</td>';
                    }
                }
            }

            // Add the custom buttons
            if (!empty($this->tableSettings->customButtons)) {
                foreach ($this->tableSettings->customButtons as $button) {
                    $table .= '<td><a href="' . $button->action . '" class="' . $button->class . '">' . $button->label . '</a></td>';
                }
            }

            $table .= '</tr>';
        }
        return $table .= '</tbody>';
    }

    /**
     * @param TableSettings $tableSettings The settings for the table
     * 
     * @return void
     */
    public function setTableSettings(TableSettings $tableSettings){
        $this->tableSettings = $tableSettings;
    }

    public function generateTable(): string{
        $table = $this->tableSettings->bootstrap ? '<table class="table table-striped">' : '<table>';
        $table .= $this->generateHeaders();
        $table .= $this->generateRows();
        return $table .= '</table>';
    }
}