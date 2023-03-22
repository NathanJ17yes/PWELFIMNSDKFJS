<?php
$genreDao = new \dao\GenreDao();
$genreid = filter_input(INPUT_GET, 'gid');
if(isset($genreid)){
    $genres = $genreDao->fetchOneGenreFromDb($genreid);
}

$updatePressed = filter_input(INPUT_POST, 'btnSave');
if(isset($updatePressed)){
    $name = filter_input(INPUT_POST, 'txtName');
    $newId = filter_input(INPUT_POST, 'txtId');
    if(trim($name)== ' '){
        echo 'please fill a valid genre name';
    }elseif(trim($genreid)== ' '){
        echo 'please fill a valid id';
    }
    else{
        $Genre = new \ent1\genre;
        $Genre -> setId($genres->getId());
        $Genre -> setName($name);
        $result = $genreDao -> updateGenreToDb($Genre);
        if($result){
            header('location:index.php?menu=genre');
        } else{
            echo '<div>Failed</div>';
        }
    }

}

?>
<form method="post">
        <label for ="txtName">Name</label>
        <input type= "text" maxlength="100" id="txtName" name="txtName" placeholder="New Genre Name"
         value = "<?php echo $genres->getName(); ?>">
        <input type = "text" maxlength = "100" id="txtId" name = "txtId" placeholder ="New Genre Id" value = "<?php echo $genres->getId(); ?>">
        <input type="submit" name="btnSave" value="Update Genre">
</form>