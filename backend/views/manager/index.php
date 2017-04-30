<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i>Poposals list</h3>
    </div>
    <div class="panel-body">
    	<div id="table-actions" class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <div class="btn-group actions">
                    <a role="button" class="btn btn-default active" href="#table" aria-controls="table" role="tab" data-toggle="tab">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>
                    <a role="button" class="btn btn-default" data-toggle="modal" data-target="#modal-dialog" data-name="proposal" data-action="content" data-modal-title="New proposal">
                        Add proposal
                    </a>
                    <a role="button" class="btn btn-default" data-toggle="modal" data-target="#modal-dialog" data-name="user" data-action="content" data-modal-title="New user">
                        Add user
                    </a>
                    <a role="button" class="btn btn-default" data-toggle="modal" data-target="#modal-dialog" data-name="date" data-action="content" data-modal-title="Chouse Date">
                        Date
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <div class="btn-group actions pull-right">
                    <a role="button" class="btn btn-default active" role="button" data-toggle="collapse" href="#filter" aria-expanded="false" aria-controls="filter">
                        <span class="glyphicon glyphicon-filter"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="filter-area" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="collapse" id="filter">
                  <div class="well">
                    ...
                  </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="content" class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="table">
                        <div class="table-responsive">
                            <table id="proposals" class="ajax-table table table-striped table-bordered" data-action="proposals-list" data-target="tbody">
                                <thead>
                                    <th><input type="checkbox" id="checkall" /></th>
                                    <th>Title</th>
                                    <th>Address</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Est. Val.</th>
                                    <th>Action</th>
                               </thead>
                               <tbody id="result"></tbody>
                               <tfooter></tfooter>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="filter">
                        Filter area
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>