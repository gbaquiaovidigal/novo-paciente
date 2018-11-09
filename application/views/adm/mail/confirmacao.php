    <section id="contact" class="bg-white"> 
        <div class="container">
            <div class="row">
            <br>
            <br>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Confirmação de Inscrição</h2>
                    <hr class="primary">
                    <br>
                    <br>
                    <?php if($error): ?>
                    <div class="alert alert-danger" role="alert"><h4><?=$error?></h4></div>
                <?php elseif ($sucess):  ?>
                    <div class="alert alert-success" role="alert"><h4><?=$sucess?></h4></div>
                <?php endif; ?>
                    <br>
                    <br>
                    <hr>
                    <a href="<?=base_url('#indexpesquisa')?>"><button class="btn btn-lg bg-primary">Voltar</button></a>
                </div>
            </div>
        </div>
    </section>