<?php

class GlobalUtility
{
    public static function createTable(array $data, array $shownTables = ['*'], $options = [] , bool $bootstrap = true) : string
    {
        $tableClass = $bootstrap ? 'table table-striped table-hover table-responsive' : '';

        $table = '<div class="' . ($bootstrap ? 'table-responsive' : '') . '">';
        $table .= '<table class="' . $tableClass . '">';
        $table .= '<thead><tr>';

        if (!empty($data)) {
            foreach (get_object_vars($data[0]) as $column => $value) {
                if ($shownTables[0] == '*') {
                    $table .= '<th>' . $column . '</th>';
                } else {
                    if (in_array($column, $shownTables)) {
                        $table .= '<th>' . $column . '</th>';
                    }
                }
            }

            $table .= '</tr></thead><tbody>';

            foreach ($data as $row) {
                $table .= '<tr>';
                foreach (get_object_vars($row) as $column => $value) {
                    if ($shownTables[0] == '*') {
                        $table .= '<td>' . $value . '</td>';
                    } else {
                        if (in_array($column, $shownTables)) {
                            $table .= '<td>' . $value . '</td>';
                        }
                    }

                }
                $table .= '</tr>';
            }

            $table .= '</tbody>';
        } else {
            $table .= '<th>No data</th>';
        }

        $table .= '</table>';
        $table .= '</div>';

        return $table;


    }

}