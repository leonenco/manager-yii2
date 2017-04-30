<?php 
use backend\widgets\notes\NotesLast;
?>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingOne">
			<h4 class="panel-title">
				<a role="button" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				Users
				</a>
			</h4>
		</div>
		<div class="panel-body">
			<div class="col-lg-12">
				<div class="row">
					<?php echo NotesLast::widget();?>
                </div>
            </div>
            <div class="col-lg-12">
                <ul class="pagination pull-right">
                  <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                  <li class="active"><a href="#">1</a></li>
                  <li><a href="#">2</a></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
                </ul>
            </div>
        </div>
    </div>
	<div class="panel panel-default">
		<div class="panel-heading" role="tab" id="headingTwo">
			<h4 class="panel-title">
				<a role="button" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
				Collapsible Group Item #2
				</a>
			</h4>
		</div>
		<div class="panel-body">
			<div class="col-lg-12">
				<div class="row">
					<div class="graf-container"></div>
				</div>
			</div>
		</div>
	</div>
</div>