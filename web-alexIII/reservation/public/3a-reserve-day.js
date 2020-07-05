var res = {
  cal : function () {
  // res.cal() : show calendar

    // Disable submit first
    document.getElementById("res_go").disabled = true;

    // AJAX data
    var data = new FormData();
    data.append('req', 'show-cal');

    // Get selected month & year - If they exist
    var select = document.querySelector("#res_date select.month");
    if (select!=null) {
      data.append('month', select.value);
      select = document.querySelector("#res_date select.year");
      data.append('year', select.value);
    }

    // AJAX call
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "reservation/2c-ajax-reserve.php", true);
    xhr.onload = function(){
      // Set contents, click, change actions
      document.getElementById("res_date").innerHTML = this.response;
      select = document.querySelector("#res_date select.month");
      select.addEventListener("change", res.cal);
      select = document.querySelector("#res_date select.year");
      select.addEventListener("change", res.cal);
      select = document.querySelectorAll("#res_date .pick, #res_date .active");
      for (var i of select) {
        i.addEventListener("click", res.pick);
      }

      // Enable submit
      document.getElementById("res_go").disabled = false;
    };
    xhr.send(data);
  },

  pick : function () {
  // res.pick() : change selected date

    var select = document.querySelector("#res_date .active");
    if (select!=this) {
      select.classList.remove("active");
      select.classList.add("pick");
      this.classList.remove("pick");
      this.classList.add("active");
    }
  },

  save : function () {
  // res.save() : save the reservation
    if(captchaSubmitted == false)
    {
        alert("Please check the Captcha test before continuing!");    
        return;
    }
    // Selected date
    var select = document.querySelector("#res_date td.active").innerHTML;
    if (select.length==1) { select = "0" + select; }
    select = document.querySelector("#res_date select.month").value + "-" + select;
    select = document.querySelector("#res_date select.year").value + "-" + select;

    var start_time = document.querySelector("#res_date select.time_start").value;
    var end_time = document.querySelector("#res_date select.end_time").value;

    var branch_address = document.querySelector("#res_date select.branch").value;
    var package = document.querySelector("#res_package select.package").value;
    // AJAX data
    var data = new FormData();
    data.append('req', 'book-day');
    data.append('name', document.getElementById("res_name").value);
    data.append('email', document.getElementById("res_email").value);
    data.append('tel', document.getElementById("res_tel").value);
    data.append('notes', document.getElementById("res_notes").value);
    data.append('res_persons_count', document.getElementById("res_persons_count").value);
    data.append('res_start', start_time);
    data.append('res_end', end_time);
    data.append('branch_address', branch_address);
    data.append('date', select);
    data.append('package', package);
    // AJAX call
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "reservation/2c-ajax-reserve.php", true);
    xhr.onload = function(){
      var res = JSON.parse(this.response);
      // OK - Redirect to thank you page
      if (res.status==1) {
        //location.href = "3d-thank-you.html";
        location.href = "reservation.php";
        alert("Successfully saved!");
      }
      // ERROR - show error
      else {
        alert(res.message);
      }
    };
    xhr.send(data);
    return false;
  }
};

window.addEventListener("load", res.cal);