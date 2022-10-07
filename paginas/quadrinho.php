<?php
    $id = $param[1] ?? null;

    if ( empty($id) ) {
        include "erro.php";
    } else {
        echo $arquivo = "https://gateway.marvel.com:443/v1/public/comics/{$id}".URL;
        
        $dados = file_get_contents($arquivo);
        $dados = json_decode($dados);

        $results = $dados->data->results[0];
        $poster = $results->thumbnail;
        $image = "{$poster->path}/standard_fantastic.{$poster->extension}";

        // $description = getDescriptionFromCharacter($results->id);
        
        // echo $results;
        ?>

        <div class="card">
            <div class="row">
                <div class="col-12 col-md-3">
                    <img src="<?=$image?>" alt="<?=$results->title?>" class="w-100">
                </div>
                <div class="col-12 col-md-9 text-justify">
                    <h1 class="text-center"><?=$results->title?></h1>
                    <p><?=$description?></p>
                </div>
            </div>
        </div>

        <h2>História:</h2>

        <div class="row">
            <?php
                echo $arquivo = "http://gateway.marvel.com/v1/public/series/{$id}".URL;

                $dados = file_get_contents($arquivo);
                $dados = json_decode($dados);

                // echo $dados;

                foreach($dados->data->results as $serie) {
                    $poster = $serie->thumbnail;
                    $image = "{$poster->path}/standard_fantastic.{$poster->extension}";
            ?>

                    <div class="col-12 col-md-3">
                        <div class="card text-center">
                            <img src="<?=$image?>" alt="">
                            <p>
                                <strong><?=$serie->title?></strong>
                            </p>
                            <p>
                                <a href="serie/<?=$serie->id?>" class="btn btn-warning">
                                    Ver mais
                                </a>
                            </p>
                        </div>
                    </div>

            <?php
                }
            ?>
        </div>

        <?php
    }
?>