$(function () {
  $('.register-form .register-form__main').validate({
    // onclick: false,
    rules: {
      "email": {
        required: true,
        email: true
      },
      "password": {
        required: true,
        minlength: 6,
      },
      "password_confirmation": {
        required: true,
        minlength: 6,
        equalTo: "#password"
      }
    },
    messages: {
      "email": {
        required: "Email là bắt buộc",
        email: "Email sai định dạng"
      },
      "password": {
        required: "Mật khẩu là bắt buộc",
        minlength: "Mật khẩu phải lớn hơn 6 ký tự",
      },
      "password_confirmation": {
        required: "Xác nhận mật khẩu là bắt buộc",
        minlength: "Xác nhận mật khẩu phải lớn hơn 6 ký tự",
        equalTo: "Xác nhận mật khẩu không hợp lệ"
      }
    }
  })

  $('.login-form .login-form__main').validate({
    rules: {
      "username": {
        required: true
      },
      "password": {
        required: true
      }
    },
    messages: {
      "username": {
        required: "Email là bắt buộc"
      },
      "password": {
        required: "Mật khẩu là bắt buộc"
      }
    }
  })
})