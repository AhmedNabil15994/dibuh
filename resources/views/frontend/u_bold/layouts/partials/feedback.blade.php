
      <div class="modal-dialog" role="document">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{trans('frontend/dashboard.feedback')}} </h4>
          </div>
          <div class="modal-body">
            {{Form::open(['class'=>'HelpForm','route'=>'feedback.store'])}}

            <span class=" label"> المــحتوي : </span>
            <div class="form-group text-area">
                <textarea class="form-control"  name="subject" rows="4"></textarea>
            </div>


          </div>
          <div class="modal-footer">
            <button  name="submit"  type="submit" class="btn btn-primary waves-effect waves-light m-r-5 ladda-button  send " >
            {{trans('button.save')}}
                 <span class=""><i class="fa fa-save"></i> </span>
            </button>

            <button type="button"  class="btn btn-danger" data-dismiss="modal">

                اغلاق
                <span><i class="fa fa-times-circle"></i></span>
                </button>
          </div>
          {{Form::close()}}

        </div>

      </div>
