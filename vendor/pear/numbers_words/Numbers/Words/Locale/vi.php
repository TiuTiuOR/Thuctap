
<?php
class Numbers_Words_Vietnamese extends Numbers_Words
{
    function numberToVietnameseWords($number) {
        $ones = array(
            0 => '',
            1 => 'một',
            2 => 'hai',
            3 => 'ba',
            4 => 'bốn',
            5 => 'năm',
            6 => 'sáu',
            7 => 'bảy',
            8 => 'tám',
            9 => 'chín'
        );
    
        $teens = array(
            0 => '',
            11 => 'mười một',
            12 => 'mười hai',
            13 => 'mười ba',
            14 => 'mười bốn',
            15 => 'mười lăm',
            16 => 'mười sáu',
            17 => 'mười bảy',
            18 => 'mười tám',
            19 => 'mười chín'
        );
    
        $tens = array(
            0 => '',
            1 => 'mười',
            2 => 'hai mươi',
            3 => 'ba mươi',
            4 => 'bốn mươi',
            5 => 'năm mươi',
            6 => 'sáu mươi',
            7 => 'bảy mươi',
            8 => 'tám mươi',
            9 => 'chín mươi'
        );
    
        $thousands = array(
            0 => '',
            1 => 'nghìn',
            2 => 'triệu',
            3 => 'tỷ',
            4 => 'nghìn tỷ',
            5 => 'triệu tỷ',
            6 => 'tỷ tỷ'
        );
    
        $number = trim($number);
        if ((int)$number == 0) {
            return 'không đồng';
        }
    
        $number = str_replace(',', '', $number);
        $results = array();
        $groups = explode('.', $number);
    
        for ($i = 0, $max = count($groups); $i < $max; $i++) {
            $groups[$i] = sprintf('%012s', $groups[$i]);
        }
    
        $number = implode('.', $groups);
        $groups = explode('.', $number);
    
        for ($i = 0, $max = count($groups); $i < $max; $i++) {
            $results[] = $this->numberToVietnameseWordsGroup($groups[$i], $thousands[$max - $i - 1]);
        }
    
        $results = array_filter($results);
        $results = array_reverse($results);
    
        return implode(' ', $results);
    }
    function numberToVietnameseWordsGroup($number, $thousandWord) {
        $number = ltrim($number, '0');
        $length = strlen($number);
        $words = array();
    
        $ones = array(
            0 => '',
            1 => 'một',
            2 => 'hai',
            3 => 'ba',
            4 => 'bốn',
            5 => 'năm',
            6 => 'sáu',
            7 => 'bảy',
            8 => 'tám',
            9 => 'chín'
        );
    
        $teens = array(
            0 => '',
            1 => 'mười',
            2 => 'hai mươi',
            3 => 'ba mươi',
            4 => 'bốn mươi',
            5 => 'năm mươi',
            6 => 'sáu mươi',
            7 => 'bảy mươi',
            8 => 'tám mươi',
            9 => 'chín mươi'
        );
    
        $thousands = array(
            0 => '',
            1 => 'nghìn',
            2 => 'triệu',
            3 => 'tỷ',
            4 => 'nghìn tỷ',
            5 => 'triệu tỷ',
            6 => 'tỷ tỷ'
        );
    
        for ($i = 0, $max = $length; $i < $max; $i++) {
            $digit = (int)$number[$i];
            $position = $max - $i - 1;
    
            switch ($position % 3) {
                case 0:
                    if ($digit == 0) {
                        // Handle zero digit in ones position
                        if ($i != $max - 1) {
                            // Skip if it's in a grouping with no significant digit
                            if ($number[$i + 1] != '0' || $number[$i + 2] != '0') {
                                $words[] = 'nghìn';
                            }
                        }
                    } else {
                        if ($digit == 1 && $i == ($max - 1)) {
                            // Handle special case for "mười"
                            $words[] = 'mười';
                        } else {
                            $words[] = $ones[$digit];
                        }
                    }
                    break;
                case 1:
                    if ($digit != 0) {
                        $words[] = $teens[$digit];
                    }
                    break;
                case 2:
                    if ($digit != 0) {
                        $words[] = $ones[$digit] . ' trăm';
                    }
                    break;
            }
    
            if ($position > 0 && $position % 3 == 2 && $number[$i + 1] != '0') {
                $words[] = '';
            }
    
            if ($position == 6 && $number[$i] != '0') {
                $words[] = 'triệu';
            }
            if ($position == 3 && $number[$i] != '0') {
                $words[] = 'nghìn';
            }
        }
    
        // Remove any leading or trailing spaces
        $words = array_filter($words);
        // Join words with proper spacing
        $result = implode(' ', $words);
        // Append thousand word if not empty
        if (!empty($result)) {
            $result .= ' ' . $thousandWord;
        }
    
        return $result;
    }
    
    
}

?>