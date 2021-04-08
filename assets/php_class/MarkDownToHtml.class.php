<?php

/*
    **Bold text**
     *Italic   *
    * **Bold italic** *
    #heading#
    --- horizontal rule
    new lines separate paragraphs
    [color:#ffffff]{text} or [color:blue]
*/

class MarkDownToHtml{    
    
    private string $str;

    private $substitutePattern = array(
        /*    input:    startStr . openMark . midStr . closeMark . endStr
         *    output:   startStr . openHTML . midStr . closeHTML . endStr
         * 
         * 
         *    startStrEnd offset, move it to adjust where startStr ends
         *       midStrEnd offset
         *           openMark 
         *                     closeMark
         *                                 closeMark offset, how far to the right will start search for closeMark, since there cen be overlap ( open *** and close ***)
         *                                    openHTML
         *                                                               closeHTML
         */
        array(0, -1, "###",    "\n",       1, "<h5>",                    "</h5>"),                           // Heading 3
        array(0, -1, "##",     "\n",       1, "<h4>",                    "</h4>"),                           // Heading 2
        array(0, -1, "#",      "\n",       1, "<h3>",                    "</h3>"),                           // Heading 1
        array(0, -3, "***",    "***",      1, "<strong><em>",            "</em></strong>"),                  // Bold and italic
        array(0, -2, "**",     "**",       1, "<strong>",                "</strong>"),                       // Bold
        array(0, -1, "*",      "*",        1, "<em>",                    "</em>"),                           // Italic
        array(0,  0, "---",    "---",      0, "\r\n\r\n<hr>\r\n\r\n",    ""),                                // Horizontal rule
        array(0,  0, "  ",     "  ",       0, "<br>\n",                  ""),                                // Line break
    );

    public function setStr( string $str ) {
        
        
        $this->str = $str;
    }

    public function getStr() {
        $this->getWithMarkDownToHTML();
        return $this->str;
    }
    
    private function getWithMarkDownToHTML() {
        
        foreach($this->substitutePattern as $pattern) {
            $this->findAndSubstitute(...$pattern);
        }

        //Img
        $this->findAndSubstituteBlock("!");
        
        //Link
        $this->findAndSubstituteBlock("");

        //TODO: Paragraphs not working
        // do{
        //     $i = strpos($this->str, "\r\n\r\n");
        //     $j = strpos($this->str, "\r\n\r\n", $i + 4);

        //     // Escape <hr> as it can't be inside <p>
        //     // if( strpos($this->str, "<hr>", $i) < $j) {
        //     //     $this->str = substr($this->str, 0, $i) . substr($this->str, $i+4, strlen($this->str));
                
        //     //     // echo "\r\n\r\n<br><br><br>----";
        //     //     // echo substr($this->str, $i, 4);
        //     //     // echo "----<br><br><br>\r\n\r\n";
        //     //     continue;
        //     // }
            
        //     // Leave trailing "\r\n\r\n" so it can be picked up for next paragraph, potentionally picks up a heading in it, best i got for now
        //     if( $i !== false && $j !== false ) $this->str = substr($this->str, 0, $i) . "<p>" . substr($this->str, $i+4, $j - $i - 4) . "</p>\n" . substr($this->str, $j, strlen($this->str));
        //     else break;
        // } while(1);
        // $this->findAndSubstitute(0, 4, -4, 0, "\r\n\r\n", "\r\n\r\n", 4, "<p>", "</p>");
    }

    private function findAndSubstituteBlock(string $openMarkBlockPrefix) {
        $depth = 0;
        while( $this->substitueBlock($openMarkBlockPrefix) && 5 > $depth++){
            //Nothing
        }

    }

    private function substitueBlock(string $openMarkBlockPrefix ) {
        $i = strpos($this->str, $openMarkBlockPrefix . "[");
        $j = strpos($this->str, "]", $i + 1);

        $text = "";

        $offset = $openMarkBlockPrefix === "" ? 1 : 2;
        if($i === false && $j === false) return false;
        $text = substr($this->str, $i + $offset, $j - $i - $offset);
        
        $urlOpen = strpos($this->str, "(", $j);
        $urlClose = strpos($this->str, ")", $urlOpen + 1);

        if( $urlOpen === false && $urlClose === false) return false;
        $url = substr($this->str, $urlOpen + 1, $urlClose - $urlOpen - 1) ;

        $insert = $openMarkBlockPrefix === "" ? 
            "<a href=\"" . $url . "\">" . $text . "</a>" :
            "<img class=\"blogPostImage\" src=\"" . $url . "\" alt=\"" . $text . "\">"; 
        
        // $urlClose + 1 to move of closing ) on url
        $this->insertOne($i, $insert, $urlClose + 1);
        return true;
    }

    private function insertOne(int $prefixStrEnd, string $insert, int $suffixStrStart) {
        $this->str = 
            substr($this->str, 0, $prefixStrEnd) . 
            $insert .
            substr($this->str, $suffixStrStart, strlen($this->str));
    }

    private function findAndSubstitute(int $start_endOffset, int $mid_endOffset, 
                                       string $openMark, string $closeMark, int $closeMark_offset, 
                                       string $openHTML, string $closeHTML){
        
        do{
            if( $this->markDownSubstitute($start_endOffset, $mid_endOffset, 
                                          $openMark, $closeMark, $closeMark_offset, 
                                          $openHTML, $closeHTML) ) 
            {
                continue;
            } else break;
        } while (1);
    }


    private function markDownSubstitute(int $start_endOffset, int $mid_endOffset, 
                                string $openMark, string $closeMark, int $closeMark_offset, 
                                string $openHTML, string $closeHTML) {
        
        $i = strpos($this->str, $openMark);
        $j = strpos($this->str, $closeMark, $i + $closeMark_offset);

        if( $i !== false && $j !== false ){
            $this->str = substr($this->str, 0, $i + $start_endOffset) . 
                         $openHTML . 
                         substr($this->str, $i + strlen($openMark), $j - $i + $mid_endOffset) . 
                         $closeHTML . 
                         substr($this->str, $j + strlen($openMark), strlen($this->str) );
            
            return 1;
        } else {
            return 0;
        }
    }
}

