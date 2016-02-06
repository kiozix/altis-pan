@if($houses)
    <div id="houses" class="panel panel-default">
        <div class="panel-heading">
            <span style="font-weight: bold;font-size: 20px !important;">Maison(s)</span>
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
                <table class="table table-responsive table-striped">
                    <?php $nbr = 1 ?>
                    @foreach($houses as $house)
                        <tr>
                            <td>#{{ $nbr }}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Position</td>
                            <td>{{ $house->pos}}</td>
                        </tr>

                        <tr>
                            <td>Inventaire</td>
                            <td>{{ $house->inventory }}</td>
                        </tr>

                        <tr>
                            <td>Conteneur</td>
                            <td>{{ $house->containers }}</td>
                        </tr>

                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>

                        <?php $nbr++ ?>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endif