<div class="modal fade" id="police" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Grade policier</h4>
            </div>
            <div class="modal-body">
                <ul>
                    <li>{{ env('POLICE_GRADE_1') }}</li>
                    <li>{{ env('POLICE_GRADE_2') }}</li>
                    <li>{{ env('POLICE_GRADE_3') }}</li>
                    <li>{{ env('POLICE_GRADE_4') }}</li>
                    <li>{{ env('POLICE_GRADE_5') }}</li>
                    <li>{{ env('POLICE_GRADE_6') }}</li>
                    <li>{{ env('POLICE_GRADE_7') }}</li>
                    <li>{{ env('POLICE_GRADE_8') }}</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pompier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Grade pompier</h4>
            </div>
            <div class="modal-body">
                <ul>
                    <li>{{ env('POMPIER_GRADE_1') }}</li>
                    <li>{{ env('POMPIER_GRADE_2') }}</li>
                    <li>{{ env('POMPIER_GRADE_3') }}</li>
                    <li>{{ env('POMPIER_GRADE_4') }}</li>
                    <li>{{ env('POMPIER_GRADE_5') }}</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>