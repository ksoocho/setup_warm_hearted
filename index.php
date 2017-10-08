<!DOCTYPE html>
<html>
	<head> 
  <meta charset="euc-kr"> </meta>
	<title>마음 따뜻한 세상</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

</head>

<body>

	<script type="text/javascript">

	 jQuery.nl2br = function(varTest){
		 return varTest.replace(/(\r\n|\n\r|\r|\n)/g, "<br>");
	 };
	
    $(document).bind("mobileinit",function() {$.mobile.page.prototype.options.addBackBtn = true; });

	function resetTextFields()
	{
		$("#postTitle").val("");
		$("#postContent").val("");
	}

    function reloadPage()
	{
		location.reload();
	}
				
	function onSuccess(data, status)
	{
		resetTextFields();
		// Notify the user the new post was saved
		$("#notification").fadeIn(2000);
		data = $.trim(data);
		if(data == "SUCCESS")
		{
			$("#notification").css("background-color", "#ffff00");
			$("#notification").text("The post was saved");
		}
		else
		{
			$("#notification").css("background-color", "#ff0000");
			$("#notification").text(data);
		}
		$("#notification").fadeOut(5000);
	}

	$(document).ready(function() {
	  
	  // Initial Global Variable
	  var user_id    = 0;
	  var feel_type  = 'A';
	  var feel_grade = 'A';
	  var user_email = ' ';
	  
	  // New Post Summit
		$("#submit").click(function(){

			var formData = $("#newPostForm").serialize();

			$.ajax({
				type: "POST",
				url: "./cks_jquery/newpost.php",
				cache: false,
				data: formData,
				success: onSuccess
			});

			return false;
		});
		
													
		$("#cancel").click(function(){
			resetTextFields();
		});

		$("#refresh_lotto").click(function(){
			location.reload();
		});

		$("#lotto_btn").click(function(){
			location.reload();
		});


		$("#refresh_list").click(function(){
			location.reload();
		});

		$("#refresh_link").click(function(){
			location.reload();
		});

		$("#refresh_post").click(function(){
			location.reload();
		});

		$("#post_reload").click(function(){
			location.reload();
		});
		

	});

	</script>

    <!-- ************************************** -->
    <!-- indexPage                              -->
    <!-- ************************************** -->
    <div data-role="page" id="indexPage" >
    
        <div data-role="header" >
            <h1>마음 따뜻한 세상</h1>
        </div>
        
				<?php
					try
					{
        
            include "./cks_jquery/cks_db.php.inc";
            
            mysql_query(" set names euckr ");
					
					  $sql=" SELECT sum(case article_type when 'WORD'  then 1 else 0 end ) word_count,  ".
                 "        sum(case article_type when 'POEM'  then 1 else 0 end ) poem_count, ".
                 "        sum(case article_type when 'STORY'  then 1 else 0 end ) story_count, ".
                 "        sum(case article_type when 'OLD'  then 1 else 0 end ) old_count, ".
                 "        sum(case article_type when 'MOVIE' then 1 else 0 end ) movie_count, ".
                 "        sum(case article_type when 'PHOTO' then 1 else 0 end ) photo_count, ".
                 "        sum(case article_type when 'MESSAGE' then 1 else 0 end ) message_count, ".
                 "        sum(case article_type when 'VIDEO' then 1 else 0 end ) video_count, ".
                 "        sum(case article_type when 'MUSIC' then 1 else 0 end ) music_count, ".
                 "        sum(case article_type when 'BOOK'  then 1 else 0 end ) book_count   ".
                 " FROM cks_photo_tbl WHERE 1 ";

					  $result=mysql_query($sql,$db_connect);
					
						while($row = mysql_fetch_array($result))
						{
								$word_count=$row[word_count];
								$message_count=$row[message_count];
								$poem_count=$row[poem_count];
								$story_count=$row[story_count];
								$old_count=$row[old_count];
								$movie_count=$row[movie_count];
								$photo_count=$row[photo_count];
								$video_count=$row[video_count];
								$music_count=$row[music_count];
								$book_count=$row[book_count];
						}

					  $sql2="select photo_id ".
					        "from cks_photo_tbl ".
					        "where article_type = 'PHOTO' ".
					        "and   article_detail_type IN ('MAIN') ".
					        "order by RAND() LIMIT 1";

					  $result2=mysql_query($sql2,$db_connect);
					
						while($row = mysql_fetch_array($result2))
						{
								$main_photo_id=$row[photo_id];
						}

					  $sql3="select photo_id ".
					        "from cks_photo_tbl ".
					        "where article_type = 'MESSAGE' ".
					        "and   photo_name IS NOT NULL ".
					        "order by RAND() LIMIT 1";

					  $result3=mysql_query($sql3,$db_connect);
					
						while($row = mysql_fetch_array($result3))
						{
								$sub_photo_id=$row[photo_id];
						}

						mysql_close($db_connect);
						
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
				?>

        <div role="main" class="ui-content">
        
            <div data-role="fieldcontain"> 
               <center>
          	   <img src=./cks_jquery/jphoto_view.php?photo_id=<?=$main_photo_id?> width="290" />			
          	   </center>
          	</div>

            <ul data-role="listview">
                <li data-role="list-divider">[ 행복한 오늘 ]
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=WORD" rel="external">오늘의 좋은 글</a> 
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=POEM" rel="external">오늘의 좋은 시</a> 
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=STORY" rel="external">오늘의 감동이야기</a> 
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=OLD" rel="external">오늘의 고전</a> 
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=MESSAGE" rel="external">오늘의 메세지</a> 
                <li data-role="list-divider">[ 마음 위로하기 ]
                <li><a href="#WordPage">좋은 글 모음</a> 
                    <span class="ui-li-count"><?=$word_count?></span> </li>
                <li><a href="#PoemPage">좋은 시 모음</a> 
                    <span class="ui-li-count"><?=$poem_count?></span> </li>
                <li><a href="#StoryPage">감동이야기 모음</a> 
                    <span class="ui-li-count"><?=$story_count?></span> </li>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=MESSAGE" rel="external">마음을 깨우는 메세지</a> 
                    <span class="ui-li-count"><?=$message_count?></span> </li>
                <li><a href="#MoviePage">감동이 있는 영화</a> 
                    <span class="ui-li-count"><?=$movie_count?></span> </li>
                <li data-role="list-divider"> [ 마음 달래기 ] 
                <li><a href="#oldPage">원문과 함께하는 고전 한마디</a> 
                    <span class="ui-li-count"><?=$old_count?></span> </li>
                <li><a href="#BookPage">책은 마음의 양식</a> 
                    <span class="ui-li-count"><?=$book_count?></span> </li>
                <li><a href="#VideoPage">감동영상/TED/명강연</a> 
                    <span class="ui-li-count"><?=$video_count?></span> </li>
                <li><a href="#MusicPage">힘을 주는 음악</a> 
                    <span class="ui-li-count"><?=$music_count?></span> </li>
                <li><a href="#photoPage">아름다운 이미지</a> 
                    <span class="ui-li-count"><?=$photo_count?></span> </li>
                <li data-role="list-divider"> <h3>[ 마음 주고받기 ]</h3>
                <li><a href="#LottoPage">행운 LOTTO</a> </li>
                <li><a href="#createNewPostPage">글 남기기</a> </li>
                <li><a href="#readBlogPage">남긴 글</a>   </li>
                <li><a href="mailto:kyoungsoo.cho@gmail.com">Mail us</a> </li>
            </ul>
            
        </div>

        <div data-role="footer">
        	<h4><small>Copyleft 2017 CKS Ideas worth Spreading</small></h4>
        </div>
        
    </div>

    <!-- ************************************** -->
    <!-- WordPage                              -->
    <!-- ************************************** -->
    <div data-role="page" id="WordPage" >
       
       <div data-role="header">
            <h1>좋은글/명문장/명수필</h1>
             <a href="" data-icon="arrow-l" id=back_video data-theme="c" class="ui-btn-left" data-iconpos="notext" data-rel="back" ></a>
             <a href="" data-icon="refresh" id=refresh_video data-theme="c" class="ui-btn-right" data-iconpos="notext"></a>
        </div>
        
        <div role="main" class="ui-content">
            <ul data-role="listview" data-theme="d" data-inset="true">
				<?php
					try
					{
					  include "./cks_jquery/cks_db.php.inc";
            
            mysql_query(" set names euckr ");
					
					  $sql="select photo_id, photo_title, upload_date, view_count from cks_photo_tbl where article_type = 'WORD' order by photo_id desc ";
					  
					  $result=mysql_query($sql,$db_connect);
					
						while($row = mysql_fetch_array($result))
						{
							echo "<li><h6><a href=http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?like_id=". $row['photo_id']." rel=external > ". $row['photo_title']."</h6></a>" ;
							echo "<span class=ui-li-count>".$row['view_count']."</span> </li>";
						}

						mysql_close($db_connect);
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
				?>
            </ul>
        </div>

        <div data-role="footer">
        	<h4><small>Copyleft 2017 CKS Ideas Worth Spreading</small></h4>
        </div>
    

    </div>

    <!-- ************************************** -->
    <!-- PoemPage                              -->
    <!-- ************************************** -->
    <div data-role="page" id="PoemPage" >
       
       <div data-role="header">
            <h1>좋은 시</h1>
             <a href="" data-icon="arrow-l" id=back_video data-theme="c" class="ui-btn-left" data-iconpos="notext" data-rel="back" ></a>
             <a href="" data-icon="refresh" id=refresh_video data-theme="c" class="ui-btn-right" data-iconpos="notext"></a>
        </div>
        
        <div role="main" class="ui-content">
            <ul data-role="listview" data-theme="d" data-inset="true">
				<?php
					try
					{
					  include "./cks_jquery/cks_db.php.inc";
            
            mysql_query(" set names euckr ");
					
					  $sql="select photo_id, photo_title, upload_date, view_count from cks_photo_tbl where article_type = 'POEM' order by photo_id desc ";
					  
					  $result=mysql_query($sql,$db_connect);
					
						while($row = mysql_fetch_array($result))
						{
							echo "<li><h6><a href=http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?like_id=". $row['photo_id']." rel=external > ". $row['photo_title']."</h6></a>" ;
							echo "<span class=ui-li-count>".$row['view_count']."</span> </li>";
						}

						mysql_close($db_connect);
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
				?>
            </ul>
        </div>

        <div data-role="footer">
        	<h4><small>Copyleft 2017 CKS Ideas Worth Spreading</small></h4>
        </div>
    

    </div>
	
    <!-- ************************************** -->
    <!-- StoryPage                              -->
    <!-- ************************************** -->
    <div data-role="page" id="StoryPage" >
       
       <div data-role="header">
            <h1>감동이야기</h1>
             <a href="" data-icon="arrow-l" id=back_video data-theme="c" class="ui-btn-left" data-iconpos="notext" data-rel="back" ></a>
             <a href="" data-icon="refresh" id=refresh_video data-theme="c" class="ui-btn-right" data-iconpos="notext"></a>
        </div>
        
        <div role="main" class="ui-content">
            <ul data-role="listview" data-theme="d" data-inset="true">
				<?php
					try
					{
					  include "./cks_jquery/cks_db.php.inc";
            
            mysql_query(" set names euckr ");
					
					  $sql="select photo_id, photo_title, upload_date, view_count from cks_photo_tbl where article_type = 'STORY' order by photo_id desc ";
					  
					  $result=mysql_query($sql,$db_connect);
					
						while($row = mysql_fetch_array($result))
						{
							echo "<li><h6><a href=http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?like_id=". $row['photo_id']." rel=external > ". $row['photo_title']."</h6></a>" ;
							echo "<span class=ui-li-count>".$row['view_count']."</span> </li>";
						}

						mysql_close($db_connect);
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
				?>
            </ul>
        </div>

        <div data-role="footer">
        	<h4><small>Copyleft 2017 CKS Ideas Worth Spreading</small></h4>
        </div>
    

    </div>	

    <!-- ************************************** -->
    <!-- MoviePage                              -->
    <!-- ************************************** -->
    <div data-role="page" id="MoviePage" >
       
       <div data-role="header">
            <h1>좋은 영화</h1>
             <a href="" data-icon="arrow-l" id=back_video data-theme="c" class="ui-btn-left" data-iconpos="notext" data-rel="back" ></a>
             <a href="" data-icon="refresh" id=refresh_video data-theme="c" class="ui-btn-right" data-iconpos="notext"></a>
        </div>
        
        <div role="main" class="ui-content">
            <ul data-role="listview" data-theme="d" data-inset="true">
				<?php
					try
					{
					  include "./cks_jquery/cks_db.php.inc";
            
            mysql_query(" set names euckr ");
					
					  $sql="select photo_id, photo_title, upload_date, view_count from cks_photo_tbl where article_type = 'MOVIE' order by photo_id desc ";
					  
					  $result=mysql_query($sql,$db_connect);
					
						while($row = mysql_fetch_array($result))
						{
							echo "<li><h6><a href=http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?like_id=". $row['photo_id']." rel=external > ". $row['photo_title']."</h6></a>" ;
							echo "<span class=ui-li-count>".$row['view_count']."</span> </li>";
						}

						mysql_close($db_connect);
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
				?>
            </ul>
        </div>

        <div data-role="footer">
        	<h4><small>Copyleft 2017 CKS Ideas Worth Spreading</small></h4>
        </div>
    

    </div>
    
    <!-- ************************************** -->
    <!-- OldPage                              -->
    <!-- ************************************** -->
    <div data-role="page" id="oldPage">
    
        <div data-role="header" >
            <h1>고전</h1>
             <a href="" data-icon="arrow-l" id=back_old data-theme="c" class="ui-btn-left" data-iconpos="notext" data-rel="back" ></a>
        </div>
        
				<?php
					try
					{
        
            include "./cks_jquery/cks_db.php.inc";
            
            mysql_query(" set names euckr ");
					
					  $sql=" SELECT sum(case article_detail_type when 'DDG'  then 1 else 0 end ) ddg_count,  ".
                 "        sum(case article_detail_type when 'JANG'  then 1 else 0 end ) jang_count, ".
                 "        sum(case article_detail_type when 'NON'  then 1 else 0 end ) non_count, ".
                 "        sum(case article_detail_type when 'ROOT' then 1 else 0 end ) root_count, ".
                 "        sum(case article_detail_type when 'MSBG' then 1 else 0 end ) msbg_count, ".
                 "        sum(case article_detail_type when 'ETC'  then 1 else 0 end ) etc_count   ".
                 " FROM cks_photo_tbl ".
                 " WHERE article_type =  'OLD' ";

					  $result=mysql_query($sql,$db_connect);
					
						while($row = mysql_fetch_array($result))
						{
								$ddg_count=$row[ddg_count];
								$jang_count=$row[jang_count];
								$non_count=$row[non_count];
								$root_count=$row[root_count];
								$msbg_count=$row[msbg_count];
								$etc_count=$row[etc_count];
						}

						mysql_close($db_connect);
						
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
				?>

        <div role="main" class="ui-content">
        

            <ul data-role="listview">
                <li data-role="list-divider"> <h3> 古典 名言 </h3>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=OLD&article_detail_type=DDG" rel="external">道德經</a> 
                    <span class="ui-li-count"><?=$ddg_count?></span> </li>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=OLD&article_detail_type=JANG" rel="external">莊子</a> 
                    <span class="ui-li-count"><?=$jang_count?></span> </li>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=OLD&article_detail_type=NON" rel="external">論語</a> 
                    <span class="ui-li-count"><?=$non_count?></span> </li>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=OLD&article_detail_type=ROOT" rel="external">菜根譚</a> 
                    <span class="ui-li-count"><?=$root_count?></span> </li>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=OLD&article_detail_type=MSBG" rel="external">明心寶鑑</a> 
                    <span class="ui-li-count"><?=$msbg_count?></span> </li>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=OLD&article_detail_type=ETC" rel="external">기타 古典 名言</a> 
                    <span class="ui-li-count"><?=$etc_count?></span> </li>
            </ul>
            
        </div>

        <div data-role="footer">
        	<h4><small>Copyleft 2017 CKS Ideas worth Spreading</small></h4>
        </div>
        
    </div>

    <!-- ************************************** -->
    <!-- PhotoPage                              -->
    <!-- ************************************** -->
    <div data-role="page" id="photoPage">
    
        <div data-role="header" >
            <h1>마음 따뜻한 사진</h1>
             <a href="" data-icon="arrow-l" id=back_photo data-theme="c" class="ui-btn-left" data-iconpos="notext" data-rel="back" ></a>
        </div>
        
				<?php
					try
					{
        
            include "./cks_jquery/cks_db.php.inc";
            
            mysql_query(" set names euckr ");
					
					  $sql=" SELECT sum(case article_detail_type when 'INSPIRATION'  then 1 else 0 end ) inspire_count,  ".
                 "        sum(case article_detail_type when 'FACE'  then 1 else 0 end ) face_count, ".
                 "        sum(case article_detail_type when 'NATURE'  then 1 else 0 end ) nature_count, ".
                 "        sum(case article_detail_type when 'ANIMAL' then 1 else 0 end ) animal_count, ".
                 "        sum(case article_detail_type when 'PLANT' then 1 else 0 end ) plant_count, ".
                 "        sum(case article_detail_type when 'FLOWER' then 1 else 0 end ) flower_count, ".
                 "        sum(case article_detail_type when 'UNIVERSE' then 1 else 0 end ) universe_count, ".
                 "        sum(case article_detail_type when 'HOUSE' then 1 else 0 end ) house_count, ".
                 "        sum(case article_detail_type when 'FUN' then 1 else 0 end ) fun_count, ".
                 "        sum(case article_detail_type when 'INSECT'  then 1 else 0 end ) insect_count   ".
                 " FROM cks_photo_tbl ".
                 " WHERE article_type =  'PHOTO' ";

					  $result=mysql_query($sql,$db_connect);
					
						while($row = mysql_fetch_array($result))
						{
								$inspire_count=$row[inspire_count];
								$face_count=$row[face_count];
								$nature_count=$row[nature_count];
								$animal_count=$row[animal_count];
								$insect_count=$row[insect_count];
								$plant_count=$row[plant_count];
								$flower_count=$row[flower_count];
								$universe_count=$row[universe_count];
								$house_count=$row[house_count];
								$fun_count=$row[fun_count];
						}

						mysql_close($db_connect);
						
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
				?>

        <div role="main" class="ui-content">
        

            <ul data-role="listview">
                <li data-role="list-divider"> <h3> 사진모음 </h3>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=PHOTO&article_detail_type=INSPIRATION" rel="external">생각나누기</a> 
                    <span class="ui-li-count"><?=$inspire_count?></span> </li>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=PHOTO&article_detail_type=FACE" rel="external">웃는 얼굴</a> 
                    <span class="ui-li-count"><?=$face_count?></span> </li>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=PHOTO&article_detail_type=NATURE" rel="external">아름다운 자연</a> 
                    <span class="ui-li-count"><?=$nature_count?></span> </li>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=PHOTO&article_detail_type=ANIMAL" rel="external">동물</a> 
                    <span class="ui-li-count"><?=$animal_count?></span> </li>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=PHOTO&article_detail_type=PLANT" rel="external">나무</a> 
                    <span class="ui-li-count"><?=$plant_count?></span> </li>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=PHOTO&article_detail_type=FLOWER" rel="external">꽃/야생화</a> 
                    <span class="ui-li-count"><?=$flower_count?></span> </li>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=PHOTO&article_detail_type=INSECT" rel="external">곤충</a> 
                    <span class="ui-li-count"><?=$insect_count?></span> </li>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=PHOTO&article_detail_type=UNIVERSE" rel="external">우주</a> 
                    <span class="ui-li-count"><?=$universe_count?></span> </li>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=PHOTO&article_detail_type=HOUSE" rel="external">멋진 집</a> 
                    <span class="ui-li-count"><?=$house_count?></span> </li>
                <li><a href="http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?article_type=PHOTO&article_detail_type=FUN" rel="external">재미있는 사진</a> 
                    <span class="ui-li-count"><?=$fun_count?></span> </li>
            </ul>
            
        </div>

        <div data-role="footer">
        	<h4><small>Copyleft 2017 CKS Ideas worth Spreading</small></h4>
        </div>
        
    </div>
    
    
    <!-- ************************************** -->
    <!-- BookPage                              -->
    <!-- ************************************** -->
    <div data-role="page" id="BookPage">
       
       <div data-role="header">
            <h1>추천도서</h1>
             <a href="" data-icon="arrow-l" id=back_list data-theme="c" class="ui-btn-left" data-iconpos="notext" data-rel="back" ></a>
             <a href="" data-icon="refresh" id=refresh_list data-theme="c" class="ui-btn-right" data-iconpos="notext"></a>
        </div>
        
        <div role="main" class="ui-content">
            <ul data-role="listview" data-theme="d" data-inset="true">
				<?php
					try
					{
					  include "./cks_jquery/cks_db.php.inc";
            
            mysql_query(" set names euckr ");
					
					  $sql="select photo_id, photo_title, upload_date, view_count from cks_photo_tbl where article_type = 'BOOK' order by photo_title ";
					  
					  $result=mysql_query($sql,$db_connect);
					
						while($row = mysql_fetch_array($result))
						{
							echo "<li><h6><a href=http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?like_id=". $row['photo_id']." rel=external > ". $row['photo_title']."</h6></a>" ;
							echo "<span class=ui-li-count>".$row['view_count']."</span> </li>";
						}

						mysql_close($db_connect);
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
				?>
            </ul>
        </div>

        <div data-role="footer">
        	<h4><small>Copyleft 2017 CKS Ideas Worth Spreading</small></h4>
        </div>
    

    </div>

    <!-- ************************************** -->
    <!-- VideoPage                              -->
    <!-- ************************************** -->
    <div data-role="page" id="VideoPage" >
       
       <div data-role="header">
            <h1>명강연/동영상</h1>
             <a href="" data-icon="arrow-l" id=back_video data-theme="c" class="ui-btn-left" data-iconpos="notext" data-rel="back" ></a>
             <a href="" data-icon="refresh" id=refresh_video data-theme="c" class="ui-btn-right" data-iconpos="notext"></a>
        </div>
        
        <div role="main" class="ui-content">
            <ul data-role="listview" data-theme="d" data-inset="true">
				<?php
					try
					{
					  include "./cks_jquery/cks_db.php.inc";
            
            mysql_query(" set names euckr ");
					
					  $sql="select photo_id, photo_title, upload_date, view_count from cks_photo_tbl where article_type = 'VIDEO' order by photo_id desc ";
					  
					  $result=mysql_query($sql,$db_connect);
					
						while($row = mysql_fetch_array($result))
						{
							echo "<li><h6><a href=http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?like_id=". $row['photo_id']." rel=external > ". $row['photo_title']."</h6></a>" ;
							echo "<span class=ui-li-count>".$row['view_count']."</span> </li>";
						}

						mysql_close($db_connect);
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
				?>
            </ul>
        </div>

        <div data-role="footer">
        	<h4><small>Copyleft 2017 CKS Ideas Worth Spreading</small></h4>
        </div>
    

    </div>

    <!-- ************************************** -->
    <!-- MusicPage                              -->
    <!-- ************************************** -->
    <div data-role="page" id="MusicPage"  >
       
       <div data-role="header">
            <h1>음악/가사</h1>
             <a href="" data-icon="arrow-l" id=back_music data-theme="c" class="ui-btn-left" data-iconpos="notext" data-rel="back" ></a>
             <a href="" data-icon="refresh" id=refresh_music data-theme="c" class="ui-btn-right" data-iconpos="notext"></a>
        </div>
        
        <div role="main" class="ui-content">
            <ul data-role="listview" data-theme="d" data-inset="true">
				<?php
					try
					{
					  include "./cks_jquery/cks_db.php.inc";
            
            mysql_query(" set names euckr ");
					
					  $sql="select photo_id, photo_title, upload_date, view_count from cks_photo_tbl where article_type = 'MUSIC' order by photo_id desc ";
					  
					  $result=mysql_query($sql,$db_connect);
					
						while($row = mysql_fetch_array($result))
						{
							echo "<li><h6><a href=http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?like_id=". $row['photo_id']." rel=external > ". $row['photo_title']."</h6></a>" ;
							echo "<span class=ui-li-count>".$row['view_count']."</span> </li>";
						}

						mysql_close($db_connect);
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
				?>
            </ul>
        </div>

        <div data-role="footer">
        	<h4><small>Copyleft 2017 CKS Ideas Worth Spreading</small></h4>
        </div>
    

    </div>    
    
    <!-- ************************************** -->
    <!-- LottoPage                           -->
    <!-- ************************************** -->
    <div data-role="page" id="LottoPage" >
        
        <div data-role="header">
            <h1>행운 LOTTO</h1>
             <a href="" data-icon="arrow-l" id=back_lotto data-theme="c" class="ui-btn-left" data-iconpos="notext" data-rel="back" ></a>
        </div>
        
        <div role="main" class="ui-content">
        
        <h2> 당신에게도 한번쯤 </h2>
        <h2> 행운이 있길 ... </h2>
        <img src="./images/lotto645.gif" width="250">
        <br><br>
        
				<?php
					$lottery_machine = range(1, 45);
        	$keys = array_rand($lottery_machine, 6);
					  
				  $count = 1;
        	foreach ($keys as $key => $value)
        	{
        		if($count < 7 && $count != 6)
        		{
        		  echo " <img src=./images/ball".$lottery_machine[$value].".gif>";
        		}
        		else
        		{
        			echo " <img src=./images/ball".$lottery_machine[$value].".gif>";
        		}
        		unset($lottery_machine[$value]);
        		$count++;
        	}	
					  
				?>
				<br>
				<fieldset class="ui-grid-a">
         <div class="ui-block-a"><a href="" id="lotto_btn" data-role="button">한번 더</a></div>
        </fieldset>
				
        </div>

        <div data-role="footer">
        	<h4><small>Copyleft 2017 CKS Ideas Worth Spreading</small></h4>
        </div>
        
    </div>

    <!-- ************************************** -->
    <!-- LikePage                           -->
    <!-- ************************************** -->
    <div data-role="page" id="LikePage" >
        
        <div data-role="header">
            <h1>좋아요</h1>
             <a href="" data-icon="arrow-l" id=back_like data-theme="c" class="ui-btn-left" data-iconpos="notext" data-rel="back" ></a>
        </div>
        
        <div role="main" class="ui-content">
            <ul data-role="listview" data-theme="d" data-inset="true">
				<?php
					try
					{
					  include "./cks_jquery/cks_db.php.inc";
            
            mysql_query(" set names euckr ");
					
					  $sql="select photo_id, article_type, photo_title, upload_date, like_count from cks_photo_tbl order by like_count desc LIMIT 0, 50 ";
					  
					  $result=mysql_query($sql,$db_connect);
					
						while($row = mysql_fetch_array($result))
						{
							echo "<li><h5><a href=http://ksoocho.cafe24.com/warm_heart/cks_jquery/jall_list.php?like_id=". $row['photo_id']."> [".$row['article_type']."] ". $row['photo_title']."</h5></a>" ;
							echo "<span class=ui-li-count>".$row['like_count']."</span> </li>";
						}

						mysql_close($db_connect);
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
				?>
            </ul>
        </div>

        <div data-role="footer">
        	<h4><small>Copyleft 2017 CKS Ideas Worth Spreading</small></h4>
        </div>
        
    </div>

    <!-- ************************************** -->
    <!-- LinkPage                           -->
    <!-- ************************************** -->
    <div data-role="page" id="LinkPage" >
        
        <div data-role="header">
            <h1>Link</h1>
             <a href="" data-icon="arrow-l" id=back_link data-theme="c" class="ui-btn-left" data-iconpos="notext" data-rel="back" ></a>
        </div>
        
        <div role="main" class="ui-content">
            <ul data-role="listview" data-theme="d" data-inset="true">
				<?php
					try
					{
					  include "./cks_jquery/cks_db.php.inc";
            
            mysql_query(" set names euckr ");
					
					  $sql="select photo_id, article_type, photo_title, upload_date, url_link from cks_photo_tbl where article_type = 'LINK' order by upload_date desc ";
					  
					  $result=mysql_query($sql,$db_connect);
					
						while($row = mysql_fetch_array($result))
						{
							echo "<li><h5><a href=". $row['url_link']." rel=external > ". $row['photo_title']."</h5></a>" ;
							echo " </li>";
						}

						mysql_close($db_connect);
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
				?>
            </ul>
        </div>

        <div data-role="footer">
        	<h4><small>Copyleft 2017 CKS Ideas Worth Spreading</small></h4>
        </div>
        
    </div>
    
    
    <!-- ************************************** -->
    <!-- createNewPostPage                      -->
    <!-- ************************************** -->
    <div data-role="page" id="createNewPostPage" >
    
        <div data-role="header">
            <h1>Create New Post</h1>
             <a href="" data-icon="arrow-l" id=back_post data-theme="c" class="ui-btn-left" data-iconpos="notext" data-rel="back" ></a>
        </div>

        <div role="main" class="ui-content">
        	<form id="newPostForm">
                <div data-role="fieldcontain">
                    <label for="postTitle"><strong>Post Title:</strong></label>
                    <input type="text" name="postTitle" id="postTitle" value=""  />

                    <label for="postContent"><strong>Post Content:</strong></label>
                    <textarea name="postContent" id="postContent"></textarea>

                    <fieldset class="ui-grid-a">
                        <div class="ui-block-a"><a href="#indexPage" id="cancel" data-role="button">Cancel</a></div>
                        <div class="ui-block-b"><button data-theme="b" id="submit" type="submit">Submit</button></div>
                    </fieldset>
				            <h3 id="notification"></h3>
                </div>
            </form>
    	</div>

      <div data-role="footer">
          <h4><small>Copyleft 2017 CKS Ideas Worth Spreading</small></h4>
      </div>
        
    </div>

    <!-- ************************************** -->
    <!-- readBlogPage                           -->
    <!-- ************************************** -->
    <div data-role="page" id="readBlogPage" >
        
        <div data-role="header">
            <h1>Read Post</h1>
             <a href="" data-icon="arrow-l" id=back_postlist data-theme="c" class="ui-btn-left" data-iconpos="notext" data-rel="back" ></a>
             <a href="" data-icon="refresh" id=refresh_post data-theme="c" class="ui-btn-right" data-iconpos="notext"></a>
        </div>
        
        <div role="main" class="ui-content">
            <ul data-role="listview" data-theme="d" data-inset="true">
				<?php
					try
					{
					  include "./cks_jquery/cks_db.php.inc";
            
            mysql_query(" set names euckr ");
					
					  $sql="select * from cks_post_tbl order by post_id desc";
					  
					  $result=mysql_query($sql,$db_connect);
					
						while($row = mysql_fetch_array($result))							
						{
							echo "<li><h2>" . $row['post_title'] . "</h2> <pre> " . $row['post_content'] . " </pre> <p class='ui-li-aside'>" . $row['post_date'] . "<strong></p>";
						}

						mysql_close($db_connect);
					}
					catch(Exception $e)
					{
						echo $e->getMessage();
					}
				?>
            </ul>
        </div>

        <div data-role="footer">
         <div data-role="navbar">
          <ul>
            <li><a href="#indexPage" id="">Home</a></li>
            <li><a href="" id="post_reload" >Reload</a></li> 
          </ul>
          </div><h4><small>Copyleft 2017 CKS Ideas Worth Spreading</small></h4>
        </div>
        
    </div>


    <!-- ************************************** -->
    <!-- End                                    -->
    <!-- ************************************** -->    

</body>
</html>