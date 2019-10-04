<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('modal_open'))
{
    function modal_open($title = 'Berhasil!', $for = 'error', $glyphicon = 'glyphicon-remove-circle')
    {
        
        return 
            '<div id="success" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="alert alert-'.$for.'" role="alert">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon '.$glyphicon.'" aria-hidden="true"></span><h4 class="title-body">'.$title.'</h4></div>
                        </div>
                        <div class="modal-body">';
    }
}

if ( ! function_exists('modal_close'))
{
    function modal_close($button = '')
    {
        return 
                        '</div>
                        <div class="modal-footer">
                            '.$button.'
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>';
    }
}

if ( ! function_exists('modal'))
{
    function modal($title = 'Berhasil!', $message, $button = '', $for = 'success', $glyphicon = 'glyphicon-ok-circle')
    {
        $button_default = '<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>';
        $button = $button.$button_default;
        $header         = '
        <div id="success" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="alert alert-'.$for.'" role="alert">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon '.$glyphicon.'" aria-hidden="true"></span><h4 class="title-body">'.$title.'</h4></div>
                        </div>';
        $body           = '
                        <div class="modal-body">'.$message.'</div>';
        $footer         = '
                        <div class="modal-footer">
                            '.$button.'
                        </div>
                    </div>
                </div>
            </div>';
        $modal = $header.$body.$footer;
        return $modal;
    }
}

if ( ! function_exists('modal_success'))
{
    function modal_success($name, $title, $url = '', $original_url = '', $title_forward = 'Konfirmasi Pembayaran', $add_message = '')
    {
        $find = array('- ', '| ', '_');
        $button_text = explode(' ',trim($title_forward));
        $title = str_replace($find, '', $title);
        $button = '';
        $title = $name.' '.$title.' berhasil';

        if (!empty($add_message)) {
            $message = p($add_message);
        }
        else
        {
            $message = '';
        }

        if (!empty($url))
        {
            if (empty($original_url)) {
                $original_url = $url;
            }

                $message .= p('Silahkan '.strtolower($title_forward) . ' melalui url berikut') . clipboard($url) . p('atau klik tombol '.strtolower($button_text[0]).' di bawah ini.');
                $button = '<a href="'.$original_url.'" class="btn btn-primary" title="'.$title_forward.'">'.$button_text[0].'</a>';
        }
        else
        {
            $message = p('Terimakasih telah berpartisipasi.');
        }

        $modal = modal($title, $message, $button);
        return $modal;
    }
}
if ( ! function_exists('modal_error'))
{
    function modal_error($name, $add_message = '', $try_again = TRUE)
    {
        $title      = $name . ' Gagal';
        if (!empty($add_message)) {
            $message    = $add_message;
        }
        if ($try_again) {
            $message    .= '<p>Harap coba lagi.</p>';
        }
        $modal = modal($title, $message, '', 'error', 'glyphicon-remove-circle');
        return $modal;
    }
}

if ( ! function_exists('modal_admin'))
{
    function modal_admin($name, $add_message = '', $button = '', $idclass = 'modal-danger')
    {
        $modal = '<div class="modal '.$idclass.' fade" id="'.$idclass.'">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">'.$name.'</h4>
                        </div>
                        <div class="modal-body">
                            <p>'.$add_message.'</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                            '.$button.'
                        </div>
                    </div>
                </div>
            </div>';
        return $modal;
    }
}

if ( ! function_exists('clipboard'))
{
    function clipboard($text)
    {
        $clipboard =    '<div class="input-group clipboard">
                            <input id="foo" type="text" class="form-control" value="'.$text.'" readonly>
                            <span class="input-group-btn">
                            <button id="copy" class="btn btn-default" data-clipboard-action="copy" data-clipboard-target="#foo"><span class="glyphicon glyphicon-copy" aria-hidden="true"></span></button>
                            </span>
                        </div>';
        return $clipboard;
    }
}

if ( ! function_exists('text_filter'))
{
    function text_filter($text)
    {
        $find = array('- ', '| ', '_');
        $text = str_replace($find, '', $text);
        /*reduce_multiples($text,' ');*/
        return $text;
    }
}

if ( ! function_exists('set_digit'))
{
    function set_digit($digit, $number)
    {
        if ($number == 0) {
            return '';
        }
        $zero = '';
        $digit = $digit - strlen($number);
        for ($i=1; $i <= $digit; $i++) {
            $zero = $zero.'0';
        }
        $num = $zero.$number;
        return $num;
    }
}

if ( ! function_exists('set_option_date')) {
    function set_option_date($value)
    {
        switch ($value) {
            case 'd':
                $date[''] = '--';
                $rangedate = range(1, 31);
                foreach ($rangedate as $key => $value) {
                    $date[$value] = $value;
                }
                return $date;
            case 'm':
                $month[''] = '--';
                setlocale(LC_TIME, 'id_ID.UTF-8');
                for ($i=1; $i <= 12; $i++) { 
                    setlocale(LC_TIME, 'id_ID.UTF-8');
                    $month[$i] = strftime('%B', mktime(0, 0, 0, $i, 1));
                }
                return $month;
            case 'y':
                $year[''] = '--';
                $rangeyear = range(1981, 2019);
                foreach ($rangeyear as $key => $value) {
                    $year[$value] = $value;
                }
                return $year;
            default:
                return FALSE;
        }
    }
}

if ( ! function_exists('key_content'))
{
    function key_content($content, $array)
    {
        foreach (array_keys($array) as $key => $value) {
            if ($content == $value) {
                $allowed = TRUE;
                break;
            }
            $allowed = FALSE;
        }
        return $allowed;
    }
}

if ( ! function_exists('reduce_multiples'))
{
    function reduce_multiples($str, $character = ',', $trim = FALSE)
    {
        $str = preg_replace('#'.preg_quote($character, '#').'{2,}#', $character, $str);
        return ($trim === TRUE) ? trim($str, $character) : $str;
    }
}
if ( ! function_exists('p'))
{
    function p($text)
    {
        return '<p>'.$text.'</p>';
    }
}
if ( ! function_exists('upper_first'))
{
    function upper_first($text)
    {
        return ucfirst(strtolower($text));
    }
}

if ( ! function_exists('form_input100'))
{
    function form_input100($text)
    {
        return ucfirst(strtolower($text));
    }
}
if ( ! function_exists('insert_at_position'))
{
    function insert_at_position($string, $insert, $position) {
        $new_string = '';
        if ($position == 0) {
            $new_string = $insert.$string;
        }elseif ($position == strlen($string)) {
            $new_string = $string.$insert;            
        }elseif ($position < strlen($string)) {
            $string = str_split($string);
            foreach ($string as $key => $value) {
                if ($key == $position) {
                    $new_string .= $insert;
                }
                $new_string .= $value;
            }            
        }else{
            return FALSE;
        }

        return $new_string;
    }
}

if ( ! function_exists('sub_string_name'))
{
    function sub_string_name($name, $length = 16)
    {
        $new_name = '';
        $array = explode(' ', $name);
        foreach ($array as $kata) {
            if (strlen($new_name) + strlen($kata) < $length) {
                $new_name .= $kata . ' ';
            }else{
                $new_name .= substr($kata, 0, 1) . ' ';
            }
        }

        return $new_name;
    }
}

