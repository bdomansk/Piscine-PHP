<?php
function if_cat($str, $id_cat)
{
    $arr = explode(":#:", $str);
    for($i = 0; isset($arr[$i]); $i++)
    {
        if ($arr[$i] == $id_cat)
            return 1;
    }
    return 0;
}
function remove_id($file, $id)
{
    if (($fd = fopen($file, "r+")) !== FALSE)
    {
        ini_set('auto_detect_line_endings', TRUE);

        $tmp = tmpfile();

        while (($arr = fgetcsv($fd, 0, ";")) !== FALSE)
        {
            if ($arr[0] !== $id)
                fputcsv($tmp, $arr, ";");
        }

        ftruncate($fd, 0);
        rewind($fd);
        rewind($tmp);

        while (($str = fgets($tmp)) !== FALSE)
        {
            fwrite($fd, $str);
        }

        fclose($fd);
        fclose($tmp);
    }
}
function what_log($string)
{
    if (($fd = fopen($string, "r")) !== FALSE)
    {
        while (($arr = fgetcsv($fd, 0, ";")) !== FALSE)
        {
            if (isset($arr[0]) && !empty($arr[0]) && !is_numeric($arr[0]))
            {
                return $arr[0];
                exit;
            }
        }
        fclose($fd);
    }
}
function next_id($p1)
{
    if (($fp = fopen($p1, "r")) !== FALSE)
    {
        $max_id = 0;
        if (file_get_contents($p1))
        {
            while (($arr = fgetcsv($fp, 0, ";")) !== FALSE)
            {
                if (isset($arr) && isset($arr[0]) && $arr[0] > $max_id)
                    $max_id = $arr[0];
            }
            $max_id++;
        }
        fclose($fp);
        return ($max_id);
    }
    return (-1);
}
function add_str($file, $str)
{
    $next_id = next_id($file);
    if (($fd = fopen($file, "r+")) !== FALSE && $next_id >= 0)
    {
        ini_set('auto_detect_line_endings', TRUE);

        $new_str = next_id($file).";".$str;
        fseek($fd, 0, SEEK_END);
        fwrite($fd, "\n".$new_str);
        fclose($fd);
    }
    else
        echo "Pizdets...#1<br>";
}
function add_str_cart($file, $str)
{
    if (($fd = fopen($file, "r+")) !== FALSE)
    {
        ini_set('auto_detect_line_endings', TRUE);

        fseek($fd, 0, SEEK_END);
        fwrite($fd, "\n".$str);
        fclose($fd);
    }
    else
        echo "Pizdets...#1<br>";
}
function rem_content($file)
{
    if (($fd = fopen($file, "r+")) !== FALSE)
    {
        ftruncate($fd, 0);
        fclose($fd);
    }
}
function edit_str($file, $str, $id)
{
    if (($fd = fopen($file, "r+")) !== FALSE)
    {
        ini_set('auto_detect_line_endings', TRUE);

        $tmp = tmpfile();

        while (($arr = fgetcsv($fd, 0, ";")) !== FALSE)
        {
            if ($arr[0] !== $id)
                fputcsv($tmp, $arr, ";");
            else
                fwrite($tmp, $str."\n");
        }

        ftruncate($fd, 0);
        rewind($fd);
        rewind($tmp);

        while (($str = fgets($tmp)) !== FALSE)
        {
            fwrite($fd, $str);
        }

        fclose($fd);
        fclose($tmp);
    }
}
?>