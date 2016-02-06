@if($offenses)
    <div id="offenses" class="panel panel-default">
        <div class="panel-heading">
            <span style="font-weight: bold;font-size: 20px !important;">Casier judiciare</span>
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
                <table class="table table-responsive table-striped">
                    <tr>
                        <th>Auteur</th>
                        <th>Infraction</th>
                        <th>Sanction</th>
                    </tr>
                    @foreach($offenses as $offense)
                        <tr>
                            <td>{{ $offense->author }}</td>
                            <td>{{ $offense->content }}</td>
                            <td>{{ $offense->sanction }}</td>
                        </tr>
                    @endforeach
                </table>
                </form>
            </div>
        </div>
    </div>
@endif