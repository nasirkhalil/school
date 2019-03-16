


@extends('layouts.admin')



@section('content')

    <section class="content-header">
        {!! header_title(__('Media')) !!}
        {!! breadcrumbs() !!}
    </section>

    <div class="row">
        <div class="col-xs-12">
            @include('flash::message')
            @include('partials.notifications')
        </div>
    </div>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{!!   __('Media') !!}</h3>

                <div class="box-tools">
                    <a href="{!! route('admin.business.index') !!}" class="btn btn-sm btn-warning btn-flat"><i
                                class="fa fa-list"></i> {!!   __('list') !!}</a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">

                {!! Form::model($business, array('method' => 'PUT','files' => true,'route' => array('admin.business.media.update', $business->id))) !!}
                {!! Form::hidden('id', $business->id) !!}


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('logo', __('Business Logo')) !!} {!! $errors->first('logo', '<span class="help-block">:message</span>') !!}
                            <input class="logo" id="logo"
                                   name="logo" type="file">

                        </div>
                    </div>



                    <hr>


                    @if($plan->status == '51')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box-header with-border">
                                <h3 class="box-title">{!! __('Business Photos') !!}</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><i
                                                class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div id="collapseTwo" class="panel-collapse collapse in">

                                    <div class="row">

                                        @if(count($photos) != 0)
                                            @foreach($photos as $photo)

                                                <div class="col-md-4" style="margin-top: 20px">
                                                    <input class="img{!! 'ph'.$photo->id !!}" id="photo"
                                                           name="imagess[]" type="file">
                                                   <input type="text" name="titles[]" placeholder="Title" class="form-control" value="{!! $photo->title !!}">
                                                   <input type="text" name="alts[]" placeholder="Alt" class="form-control" value="{!! $photo->alt !!}">
                                                   <input type="text" name="descriptions[]" placeholder="Description" class="form-control" value="{!! $photo->description !!}">
                                                    <input type="hidden" name="picID[]" value="{!! $photo->id !!}">
                                                </div>
                                            @endforeach

                                            <?php for ($i = count($photos); $i < trim($plan->photos) ; $i++){?>
                                            <div class="col-md-4" style="margin-top: 20px">
                                                <input class="img<?=$i?>" id="photo"
                                                       name="images[]" type="file">
                                                <input type="text" name="title[]" placeholder="Title" class="form-control">
                                                <input type="text" name="alt[]" placeholder="Alt" class="form-control">
                                                <input type="text" name="description[]" placeholder="Description" class="form-control">
                                            </div>
                                            <?php }?>
                                        @endif
                                        @if(count($photos) == 0)
                                            <?php for ($i = 0; $i < trim($plan->photos) ; $i++){?>
                                            <div class="col-md-4 mb20" style="margin-top: 20px">
                                                <input class="img<?=$i?>" id="photo"
                                                       name="images[]" type="file">
                                            </div>
                                            <?php }?>
                                        @endif

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>{!! __('Save')!!}</button>
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>




                    {!! Form::close() !!}

                </div>
            </div>

    </section>


    <script>
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {
                color: '#3cc8ad'
                , secondaryColor: '#db5554'
                , className: 'switchery'
                , disabled: false
                , disabledOpacity: 0.5
                , speed: '0.5s'
            });
        });


        <?php if($logo){?>
        $('.logo').ezdz({
            text: '<img src="{!! has_image('uploads/images/'.$logo->value) !!}">'
        });
        <?php }else{?>

           $('.logo').ezdz({
            text: 'Select Logo'
        });

                <?php }?>

        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {
                color: '#3cc8ad'
                , secondaryColor: '#db5554'
                , className: 'switchery'
                , disabled: false
                , disabledOpacity: 0.5
                , speed: '0.5s'
            });
        });


        <?php if(count($photos) != 0){?>
        <?php foreach($photos as $photo):?>
        $('.img<?='ph'.$photo->id ?>').ezdz({
            text: '<img src="{!! has_image('uploads/images/'.$photo->value) !!}">'
        });
        <?php endforeach;?>
        <?php for ($i = count($photos); $i < trim($plan->photos) ; $i++){?>
          $('.img<?=$i?>').ezdz({
            text: 'Select Photo'
        });
        <?php }?>
        <?php }else{?>

         <?php for ($i = 0; $i < trim($plan->photos) ; $i++){?>
          $('.img<?=$i?>').ezdz({
            text: 'Select Photo'
        });
        <?php }?>
        <?php }?>

    </script>

@endsection





