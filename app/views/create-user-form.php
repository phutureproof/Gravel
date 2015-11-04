<form action="" method="post" accept-charset="utf-8">

    @include('utilities/form-errors')

    <div class="form-group">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" class="form-control" value="<?= @$_POST['firstname']; ?>">
    </div>
    <div class="form-group">
        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname" class="form-control" value="<?= @$_POST['lastname']; ?>">
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" class="form-control" value="<?= @$_POST['email']; ?>">
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="text" name="password" id="password" class="form-control" value="<?= @$_POST['password']; ?>">
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Save</button>
        <button class="btn btn-danger" type="reset">Reset</button>
    </div>
</form>