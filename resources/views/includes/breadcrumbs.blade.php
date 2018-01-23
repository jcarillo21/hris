
        <div class="page-header">
            <h1 class="title">{{$page}}</h1>
            <ol class="breadcrumb">
                <li class="active">{{$desc}}</li>
            </ol>
            <div class="right">
                <div class="btn-group" role="group" aria-label="...">
                    <a href="<?php echo url('/'); ?>" class="btn btn-light">{{$page}}</a>
                    <a onclick="location.reload()" href="#"  class="btn btn-light"><i class="fa fa-refresh"></i></a>
                </div>
            </div>
        </div>