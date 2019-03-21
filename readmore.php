//WP filter to replace long text with a read more link
function read_more_transcript_filter($content) {
	if( is_singular() && is_main_query() && get_post_type()=='podcast') {
    $transcript_pos = stripos($content,"Full Episode Transcript");
    if($transcript_pos!==false){
      $transcript_firstbr = stripos($content,"<p>",$transcript_pos);
      //+2 for <p> char length
      $transcript_secondbr = stripos($content,"<p>",$transcript_firstbr+2);
      if($transcript_firstbr !== false && $transcript_secondbr !==false){
        $new_content= substr($content,0,$transcript_secondbr)."<a href='#' id='read-full-transcript' onclick='document.getElementById(\"hidden-text\").style.display=\"block\"; document.getElementById(\"read-full-transcript\").style.display=\"none\"; return false;' > ... Read Full Transcript</a>";
        $new_content.="<div id='hidden-text' style='display: none;'><p>".substr($content,$transcript_secondbr)."</div>";
        $content=$new_content;
      }
    }
	}
	return $content;
}
