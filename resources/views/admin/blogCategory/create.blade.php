
<div class="panel-body">
    <form class="form-horizontal" action="{{ route('blogCategory.store') }}" method="POST">
        @csrf

        <fieldset class="content-group">
            <legend class="text-bold"></legend>

            <div class="form-group">
                <label class="control-label col-lg-2">Name</label>
                <div class="col-lg-10">
                    <input type="text" name="name" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-lg-2">Status</label>
                <div class="col-lg-10">
                    <select name="valid" class="form-control">
                        <option value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">In Active</option>
                    </select>
                </div>
            </div>

        </fieldset>

    </form>
</div>
       
