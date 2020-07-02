<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="auth">
  <div class="auth__header">
    
  </div>
  <div class="auth__body">
    <form class="auth__form" autocomplete="off" action="/register" method="post">
      <div class="auth__form_body">
        <h3 class="auth__form_title">
        <img src="images/logo.svg" alt="" width="50">
        Peperoni App
        </h3>
        <div>
          <div class="form-group">
            <label class="text-uppercase small">Email</label>
            <input type="email" class="form-control" placeholder="Enter email" value="<?= set_value('email')?>" name="email">
          </div>
          <div class="form-group">
            <label class="text-uppercase small" >Password</label>
            <input type="password" class="form-control" placeholder="Password" value="<?= set_value('password')?>" name="password">
          </div>
          <div class="form-group">
            <label class="text-uppercase small">Address</label>
            <textarea name="address"  class="form-control" placeholder="Address" value="<?= set_value('address')?>" name="address"></textarea>
          </div>
          <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="1" name="role">I'ma manager
            </label>
        </div>
        </div>
      </div>
      <div class="auth__form_actions">
        <button class="btn btn-primary btn-lg btn-block">
          NEXT
        </button>
        <div class="mt-2">
          <a href="/signin" class="small text-uppercase">
            SIGN IN INSTEAD
          </a>
        </div>
      </div>
    </form>
    
  </div>
</div>
<?= $this->endSection() ?>