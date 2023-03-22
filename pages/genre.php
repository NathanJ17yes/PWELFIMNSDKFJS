
    <?php
    $genreDao = new \dao\GenreDao();

        $saveButtonPressed = filter_input(INPUT_POST, 'btnSave');
        if(isset($saveButtonPressed)){
            $name = filter_input(INPUT_POST, 'txtName');
            if(trim($name)==''){
                echo 'please fill a valid genre name';

            }else{
                $genre = new \ent1\Genre();
                $result = $genreDao->addGenretodb($genre);
                if ($result) {
                    echo 'Data Succesfully Loaded';
                  }else {
                    echo 'Failed to add data';
                  }
            }
            
        }
        $deleteCommand = filter_input(INPUT_GET, 'cmd');
        if(isset($deleteCommand)){
            $genreid = filter_input(INPUT_GET, 'gid');
            $result = $genreDao->deleteGenre($genreid);
            if($result){
                echo 'Data Succesfully deleted';
            }else{
                echo 'Data Failed to Remove';
            }
        }
    ?>
<body>
    <form method="post">
        <label for ="txtId">Id</label>
        <label for ="txtName">Name</label>
        <input type= "text" maxlength="100" id="txtName" name="txtName" placeholder="New Genre Name">
        <input type="submit" name="btnSave" value="Save Genre">
    </form>
   <?php
        $link = createMySQLConnection();
        $query = 'SELECT id, Nama_genre FROM genre';
        $stmt = $link -> prepare($query);
        $stmt ->execute();
        $result = $stmt->fetchALL();
        $link = null;
    ?>
    <main>
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
            <tbody>
            <?php
                $genres = $genreDao->fetchGenreFromDb();
                foreach ($genres as $genre){
                    echo '<tr>';
                    echo '<td>' . $genre->getId(). '</td>';
                    echo '<td>'. $genre->getName().'</td>';
                    echo '<td>
                    <button onclick = "editGenre('. $genre->getId().')" class = "btn"> Edit Data </button> 
                    <button onclick = "deleteGenre('. $genre->getId().')" class = "btn"> Delete Data </button> </td>';
                    echo '</tr>';
                } 
            ?>
            </tbody>
        </table> 
    </main>
</body>
<script src ="js/genre_index.js" ></script>


