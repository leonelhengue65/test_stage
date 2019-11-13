@extends('layout')
@section('title', 'List')

@section('layout_content')

    <div class="row">
        <div class="col-lg-12 col-md-12  stretch-card">
            <div class="row" style="margin-top: 2%; margin-left: 10px;margin-bottom: 10px">
                <?php
                for ($i=0; $i<AgregateurController::count();$i++){
                ?>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;margin-bottom: 20px">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo($agregateurs[$i]->nom);?>
                            </h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" style="float: left;border: 1px solid #f78ca0; border-radius: 20px; padding: 6px" class="card-link">En savoir plus</a>
                            <a href="{{Agregateur::classpath()}}route?route={{$agregateurs[$i]->reference}}" style="float: right;border: 1px solid #3f6ad8; border-radius: 20px; padding: 6px" class="card-link">Continuer</a>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
@endsection
