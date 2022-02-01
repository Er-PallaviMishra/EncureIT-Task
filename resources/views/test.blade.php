<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>

<body>
    <ul style="color: blue">
    <?php
        foreach($parentData as $parent): ?>

        <li>{{ $parent->name }}</li>
        <ul>
        <?php
foreach ($parent->children as $content): ?>
        <li style="color: red">
            {{ $content->name }}</li>
            <ul>
                <?php
foreach($content->children as $drop): ?>

                <li style="color: green">{{ $drop->name }}</li>

                <?php endforeach;?>
            </ul>

        <?php
endforeach;
?>
    </ul>
    <?php
endforeach;
?>
</ul>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Add data
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    {!! Form::open(['id' => 'formData']) !!}
                    <div class="form-group row">
                        <div class="col-md-6">
                            {!! Form::text('name', $model->name, ['id' => 'user-name', 'autocomplete' => 'off']) !!}

                            <div id="user-name-invalid" class="d-none"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            {!! Form::select('parent_id', $model->parentList(), $model->parentList($model->parent_id)) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>

<script>
    $(document).ready(function() {
        $("input").blur(function(e) {
            e.preventDefault();
            var name = $('#user-name').val();
            if (name == '' || name == 'undefined') {

                $("#user-name-invalid").removeClass('d-none');
                $("#user-name-invalid").text('name is empty');
                return false;
            } else {

                if (!name.match('[a-zA-Z]')) {
                    console.log(name);
                    $("#user-name-invalid").removeClass('d-none');
                    $("#user-name-invalid").text('name should contain only letters');
                    return false;
                } else {

                    $("#user-name-invalid").addClass('d-none');
                }
            }

        });
        $("#formData").submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "{{ url('data') }}",
                data: data,
                success: function(response) {
                    var result = JSON.parse(response)
                    if (result.status == "OK") {

                        location.reload();
                    }
                }
            });

        });

    })
</script>
