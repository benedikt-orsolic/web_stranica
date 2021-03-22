<?php

require_once 'dbConn.inc.php';
include_once 'constants.inc.php';

if( !isset($_POST['submit']) ) {
    die();
}


$upid = $_POST['upid'];

if( $upid == -1 ) {
    $sql = "SELECT * FROM blog_posts ORDER BY upid DESC LIMIT 5;";
} else {
    $sql = "SELECT * FROM blog_posts WHERE upid = ?;";
}

$stmt = mysqli_stmt_init( $dbConn );
$result = NULL;

if( !mysqli_stmt_prepare( $stmt, $sql )) {
    file_put_contents ( '../../db_error.log.txt' , 'assets/php_lib/get_blog_posts.php no function'.mysqli_error($dbConn)."\r\n ", FILE_APPEND | LOCK_EX);
    die();
}

if( $upid != -1 ) {
    do{
        $upid--;
        if( $upid < 0) {
            file_put_contents ('../../logs/error.log.txt' , date('Y-m-d H:i:s').' - '.'$upid < 0'."\r\n" , FILE_APPEND | LOCK_EX);
            die();
        }
        mysqli_stmt_bind_param( $stmt, 'i', $upid);
        
        mysqli_stmt_execute( $stmt );
        $result = mysqli_stmt_get_result( $stmt );

    } while ( mysqli_num_rows($result) == 0 );
} else {
    mysqli_stmt_execute( $stmt );
    $result = mysqli_stmt_get_result( $stmt );
}

$markDownToHtml = new MarkDownToHtml();

while($row = mysqli_fetch_assoc($result)){
    
    $markDownToHtml->setStr( $row['text'] );

    echo( '<article id="blogPost=' .$row['upid']. '" class="blogPost">' . "\n");
    echo( '<h2 class="postTiele">'.$row['title'].'</h2>' . "\n" );
    echo( '<section class="postText">' . "\n\n" . $markDownToHtml->getStr() . '</section></article>' . "\n\n" );
}

unset( $markDownToHtml );

mysqli_stmt_close( $stmt );






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
        /*
        //Color
        do{
            $i = strpos($str, "[color:");
            $j = strpos($str, "]", $i + 1);

            $color = "";
            if( $i !== false && $j !== false ) $color = substr($str, $i+7, $j - $i - 7);
            else break;
            
            $textOpen = strpos($str, "{");
            $textClose = strpos($str, "}");

            if( $textOpen !== false && $textClose !== false && $i !== false && $j !== false ) {
                $str = 
                substr($str, 0, $i) . 
                "<span style='color: " . 
                $color . "'>" . 
                substr($str, $textOpen+1, $textClose - $textOpen - 1) . 
                "</span>" . 
                substr($str, $textClose+1, $len);
            }
            else break;
        } while(1);
        */
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