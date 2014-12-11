<button class="btn btn-primary" data-toggle="modal" data-target="#newConvoModal">
    Create New &nbsp;
    <i class="glyphicon glyphicon-plus"></i>
</button>
<br>

<!-- Modal -->
<div class="modal fade" id="newConvoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Create New Conversation</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        {{ Form::open(['url' => '/conversation']) }}

                            <div class="row">
                                {{ Form::text('recipient', '', ['class' => 'form-control', 'placeholder' => 'Username', 'id' => 'username', 'autofocus' => true] )}}
                                {{ Form::hidden('userID', $user->id, ['id' => 'userID']) }}
                                <br />
                                <span class="pull-right">
                                    <button class="btn btn-primary" type="submit" id="convo-submit">Create</button>
                                    <button class="btn btn-default" type="submit" data-dismiss="modal">Cancel</button>
                                </span>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>