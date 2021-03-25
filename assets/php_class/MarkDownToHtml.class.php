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

    public function setStr( string $str ) {
        
        
        $this->str = $str;
    }

    public function getStr() {
        $this->getWithMarkDownToHTML();
        return $this->str;
    }
    
    private function getWithMarkDownToHTML() {
        
        //Lowest heading
        do{
            
            // new line char at index $j has to be left or paragraph wont be recognised later
            if( $this->markDownSubstitute(0, 3, -1, -1, "###", "\n", 1, "<h5>", "</h5>") ) continue;
            else break;
        } while(1);

        //Middle heading
        do{

            // new line char at index $j has to be left or paragraph wont be recognised later
            if( $this->markDownSubstitute(0, 2, -1, -1, "##", "\n", 1, "<h4>", "</h4>") ) continue;
            else break;
        } while(1);

        //Highest heading
        do{

            // new line char at index $j has to be left or paragraph wont be recognised later
            if( $this->markDownSubstitute(0, 1, -1, -1, "#", "\n", 1, "<h3>", "</h3>") ) continue;
            else break;
        } while(1);
        
        //Color
        do{
            $i = strpos($this->str, "[color:");
            $j = strpos($this->str, "]", $i + 1);

            $color = "";
            if( $i !== false && $j !== false ) $color = substr($this->str, $i+7, $j - $i - 7);
            else break;
            
            $textOpen = strpos($this->str, "{");
            $textClose = strpos($this->str, "}");

            if( $textOpen !== false && $textClose !== false && $i !== false && $j !== false ) {
                $this->str = 
                substr($this->str, 0, $i) . 
                "<span style='color: " . 
                $color . "'>" . 
                substr($this->str, $textOpen+1, $textClose - $textOpen - 1) . 
                "</span>" . 
                substr($this->str, $textClose+1, strlen($this->str));
            }
            else break;
        } while(1);

        //Link
        do{
            $i = strpos($this->str, "[");
            $j = strpos($this->str, "]", $i + 1);

            $linkText = "";

            if( $i !== false && $j !== false ) $linkText = substr($this->str, $i + 1, $j - $i - 1);
            else break;
            
            $urlOpen = strpos($this->str, "(");
            $urlClose = strpos($this->str, ")");

            if( $urlOpen !== false && $urlClose !== false && $i !== false && $j !== false ) $url = substr($this->str, $urlOpen + 1, $urlClose - $urlOpen - 1) ;
            else break;
            
            $this->str = 
                substr($this->str, 0, $i) . 
                "<a href=\"" . $url . "\">" . $linkText . "</a>" .
                substr($this->str, $urlClose+1, strlen($this->str));
            
        } while(1);
        
        //Bold and italic text
        do{

            // new line char at index $j has to be left or paragraph wont be recognised later
            if( $this->markDownSubstitute(0, 3, -3, 3, "***", "***", 1, "<strong><em>", "</em></strong>") ) continue;
            else break;
        } while(1);
        
        //Bold text
        do{

            if( $this->markDownSubstitute(0, 2, -2, 2, "**", "**", 1, "<strong>", "</strong>") ) continue;
            else break;
        } while(1);

        //Italic
        do{

            if( $this->markDownSubstitute(0, 1, -1, 1, "*", "*", 1, "<em>", "</em>") ) continue;
            else break;
        } while(1);
        
        //Horizontal rule
        // Add 2 new lines in front and back to help paragraph section detect it since firefox doesn't like it as <p> <hr> </p>
        do{

            if( $this->markDownSubstitute(0, 0, 0, +3, "---", "---", 0, "\r\n\r\n<hr>\r\n\r\n", "") ) continue;
            else break;
        } while(1);

        //Line break
        // Add 2 new lines in front and back to help paragraph section detect it since firefox doesn't like it as <p> <hr> </p>
        do{
            if( $this->markDownSubstitute(0, 0, 0, +3, "  ", "  ", 0, "<br>", "") ) continue;
            else break;
        } while(1);


        //Paragraphs
        do{
            $i = strpos($this->str, "\r\n\r\n");
            $j = strpos($this->str, "\r\n\r\n", $i + 4);

            // Escape <hr> as it can't be inside <p>
            if( strpos($this->str, "<hr>", $i) < $j) {
                $this->str = substr($this->str, 0, $i) . substr($this->str, $i+4, strlen($this->str));
                continue;
            }
            
            // Leave trailing "\r\n\r\n" so it can be picked up for next paragraph, potentionally picks up a heading in it, best i got for now
            if( $i !== false && $j !== false ) $this->str = substr($this->str, 0, $i) . "<p>" . substr($this->str, $i+4, $j - $i - 4) . "</p>\n" . substr($this->str, $j, strlen($this->str));
            else break;
        } while(1);
        
    }


    private function markDownSubstitute(int $start_endOffset, int $mid_stratOffest, int $mid_endOffset, int $end_startOffset, 
                                string $openMark, string $closeMark, int $closeMark_offset, 
                                string $openHTML, string $closeHTML) {
        
        $i = strpos($this->str, $openMark);
        $j = strpos($this->str, $closeMark, $i + $closeMark_offset);

        if( $i !== false && $j !== false ){
            $this->str = substr($this->str, 0, $i + $start_endOffset) . 
                         $openHTML . 
                         substr($this->str, $i + $mid_stratOffest, $j - $i + $mid_endOffset) . 
                         $closeHTML . 
                         substr($this->str, $j + $end_startOffset, strlen($this->str) );
            
            return 1;
        } else {
            return 0;
        }
    }
}