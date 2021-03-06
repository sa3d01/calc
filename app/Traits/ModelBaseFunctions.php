<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Str;

trait ModelBaseFunctions
{
    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    private function upload_file($file)
    {
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move($this->images_link, $filename);
        return $filename;
    }

    function deleteFileFromServer($filePath)
    {
        if ($filePath != null) {
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }

    protected function setImageAttribute()
    {
        $image = request('image');
        $filename = null;
        if (is_file($image)) {
            $filename = $this->upload_file($image);
        } elseif (filter_var($image, FILTER_VALIDATE_URL) === True) {
            $filename = $image;
        }
        $this->attributes['image'] = $filename;
    }

    protected function getImageAttribute()
    {
        $dest = $this->images_link;
        try {
            if ($this->attributes['image'])
                return asset($dest) . '/' . $this->attributes['image'];
            return asset('media/images/logo.jpeg');
        } catch (\Exception $e) {
            return asset('media/images/logo.jpeg');
        }
    }

    protected function setStartDateAttribute()
    {
        if (request('start_date')!=null){
            if ( is_numeric(request('start_date')) && (int)request('start_date') == request('start_date') ){
                $this->attributes['start_date'] = request('start_date');
            }else{
                $this->attributes['start_date'] = Carbon::parse(request('start_date'))->timestamp;
            }
        }
    }
    protected function setEndDateAttribute($endDate)
    {
        if ($endDate!=null){
            if ( is_numeric($endDate) && (int)$endDate == $endDate ){
                $this->attributes['end_date'] = $endDate;
            }else{
                $this->attributes['end_date'] = Carbon::parse($endDate)->timestamp;
            }
        }
    }
    protected function setPasswordAttribute($password)
    {
        if (isset($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function showTimeStampDate($timestamp)
    {
        return $this->ArabicTimeDate(Carbon::createFromTimestamp($timestamp));
    }

    public function published_from()
    {
        $created_at = Carbon::parse($this->attributes['created_at']);
        return $this->time($created_at->timestamp);
    }

    function time($timestamp, $num_times = 3)
    {
        $times = array(31536000 => '??????', 2592000 => '??????', 604800 => '??????????', 86400 => '??????', 3600 => '????????', 60 => '??????????', 1 => '??????????');
        $now = time() - 3600;
        $timestamp -= 3600;
        $secs = $now - $timestamp;
        if ($secs == 0) {
            $secs = 1;
        }
        $count = 0;
        $time = '';
        foreach ($times as $key => $value) {
            if ($secs >= $key) {
                $s = '';
                $time .= floor($secs / $key);

                if ((floor($secs / $key) != 1)) $s = ' ';

                $time .= ' ' . $value . $s;
                $count++;
                $secs = $secs % $key;

                if ($count > $num_times - 1 || $secs == 0) break; else
                    $time .= ' ?? ';
            }
        }
        $st = '?????? ' . $time;
        return $st;
    }

    public function published_at()
    {
        return $this->ArabicDate($this->attributes['created_at']);
    }

    function ArabicDate($date)
    {
        $created_at = Carbon::parse($date);
        $months = array("Jan" => "??????????", "Feb" => "????????????", "Mar" => "????????", "Apr" => "??????????", "May" => "????????", "Jun" => "??????????", "Jul" => "??????????", "Aug" => "??????????", "Sep" => "????????????", "Oct" => "????????????", "Nov" => "????????????", "Dec" => "????????????");
        $your_date = $created_at->format('y-m-d');
        $en_month = date("M", strtotime($your_date));
        foreach ($months as $en => $ar) {
            if ($en == $en_month) {
                $ar_month = $ar;
            }
        }
        $find = array("Sat", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri");
        $replace = array("??????????", "??????????", "??????????????", "????????????????", "????????????????", "????????????", "????????????");
        $ar_day_format = $created_at->format('D');
        $ar_day = str_replace($find, $replace, $ar_day_format);
        header('Content-Type: text/html; charset=utf-8');
        $standard = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $eastern_arabic_symbols = array("??", "??", "??", "??", "??", "??", "??", "??", "??", "??");
        $current_date = $ar_day . ' ' . $created_at->format('d') . ' / ' . $ar_month . ' / ' . $created_at->format('Y');
        return str_replace($standard, $eastern_arabic_symbols, $current_date);
    }

    function ArabicTimeDate($date)
    {
        $created_at = Carbon::parse($date);
        $months = array("Jan" => "??????????", "Feb" => "????????????", "Mar" => "????????", "Apr" => "??????????", "May" => "????????", "Jun" => "??????????", "Jul" => "??????????", "Aug" => "??????????", "Sep" => "????????????", "Oct" => "????????????", "Nov" => "????????????", "Dec" => "????????????");
        $your_date = $created_at->format('y-m-d');
        $en_month = date("M", strtotime($your_date));
        foreach ($months as $en => $ar) {
            if ($en == $en_month) {
                $ar_month = $ar;
            }
        }
        $find = array("Sat", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri");
        $replace = array("??????????", "??????????", "??????????????", "????????????????", "????????????????", "????????????", "????????????");
        $ar_day_format = $created_at->format('D');
        $ar_day = str_replace($find, $replace, $ar_day_format);
        header('Content-Type: text/html; charset=utf-8');
        $standard = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $eastern_arabic_symbols = array("??", "??", "??", "??", "??", "??", "??", "??", "??", "??");
        $current_date = $ar_day . ', ' . $created_at->format('d') . ' ' . $ar_month . ' ' . $created_at->format('Y') . ' ,' . '  ???????????? ' . $created_at->format('H:i');
        return str_replace($standard, $eastern_arabic_symbols, $current_date);
    }

}
