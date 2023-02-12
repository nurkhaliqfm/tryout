var baseUrl = window.location.origin;

const XhttpSession = () => {
  var csrfName = document.getElementById("txt_csrfname").getAttribute("name");
  var csrfHash = document.getElementById("txt_csrfname").value;

  const data = {};
  data["key"] = "make_session";
  data[csrfName] = csrfHash;

  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", baseUrl + "/session-create", true);
  xhttp.onreadystatechange = () => {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      var response = JSON.parse(xhttp.responseText);
      document.getElementById("txt_csrfname").value = response["value"];
      document.getElementById("txt_csrfname").name = response["name"];

      if (response["status"] === "Success") {
        let session = response["session_id"];
        localStorage.setItem("session_id", JSON.stringify(session));
        window.location.replace(baseUrl + "/online-simulation");
      } else {
        $("#modelLoginPeserta").modal("hide");
        $("#modeResultPreliminaryTest").modal("hide");
        const toast = document.querySelector(".toast");
        (closeIcon = document.querySelector(".close")),
          (progress = document.querySelector(".progress"));
        let timer1, timer2;
        toast.classList.add("active");
        progress.classList.add("active");

        document.querySelector(".toast .text-1").innerHTML = "Limited Access";
        document.querySelector(".toast .text-2").innerHTML =
          "Can't Join Preliminary Test";

        timer1 = setTimeout(() => {
          toast.classList.remove("active");
        }, 5000);
        timer2 = setTimeout(() => {
          progress.classList.remove("active");
        }, 5300);
        closeIcon.addEventListener("click", () => {
          toast.classList.remove("active");
          setTimeout(() => {
            progress.classList.remove("active");
          }, 300);
          clearTimeout(timer1);
          clearTimeout(timer2);
        });
      }
    }
  };
  xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
  xhttp.setRequestHeader("Content-Type", "application/json");
  xhttp.send(JSON.stringify(data));
};

const XhttpLoginSimulation = () => {
  var csrfName = document.getElementById("txt_csrfname").getAttribute("name");
  var csrfHash = document.getElementById("txt_csrfname").value;
  var email = document.querySelector(".form-control.email").value;
  var password = document.querySelector(".form-control.password").value;

  const data = {};
  data["key"] = "simulation_result";
  data[csrfName] = csrfHash;
  data["email"] = email;
  data["password"] = password;
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", baseUrl + "/login-simulation", true);
  xhttp.onreadystatechange = () => {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      var response = JSON.parse(xhttp.responseText);
      document.getElementById("txt_csrfname").value = response["value"];
      document.getElementById("txt_csrfname").name = response["name"];
      let status = response["status"];
      if (status === "Failed") {
        $("#modelLoginPeserta").modal("hide");
        const toast = document.querySelector(".toast");
        (closeIcon = document.querySelector(".close")),
          (progress = document.querySelector(".progress"));
        let timer1, timer2;
        toast.classList.add("active");
        progress.classList.add("active");

        if (response["no_data"]) {
          document.querySelector(".toast .text-1").innerHTML = "Not Found";
          document.querySelector(".toast .text-2").innerHTML =
            "Test Result Not Found";
        } else {
          document.querySelector(".toast .text-1").innerHTML = "Login Failed";
          document.querySelector(".toast .text-2").innerHTML =
            "Email atau Password Salah";
        }
        timer1 = setTimeout(() => {
          toast.classList.remove("active");
        }, 5000);
        timer2 = setTimeout(() => {
          progress.classList.remove("active");
        }, 5300);
        closeIcon.addEventListener("click", () => {
          toast.classList.remove("active");
          setTimeout(() => {
            progress.classList.remove("active");
          }, 300);
          clearTimeout(timer1);
          clearTimeout(timer2);
        });
      } else if (status === "Success") {
        let resultModalTitle = document.querySelector(
          "#modal-body__result .result-title"
        );
        let resultModalDesc = document.querySelector(
          "#modal-body__result .result-desc"
        );

        if (response["test_result"] == "success") {
          resultModalTitle.innerHTML = "Congratulation";
          resultModalTitle.setAttribute(
            "style",
            "font-weight: 800; color: green;"
          );
          resultModalDesc.innerHTML = "You Made It To The Semifinal";
        } else {
          resultModalTitle.innerHTML = "Failed";
          resultModalTitle.setAttribute(
            "style",
            "font-weight: 800; color: red;"
          );
          resultModalDesc.innerHTML =
            "You Didn't Made It To The Semifinal. See You Next Year";
        }

        $("#modelLoginPeserta").modal("hide");
        $("#modeResultPreliminaryTest").modal("show");
      }
    }
  };
  xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
  xhttp.setRequestHeader("Content-Type", "application/json");
  xhttp.send(JSON.stringify(data));
};

const goBtnHandle = () => {
  XhttpSession();
};

const loginBtnHandle = () => {
  XhttpLoginSimulation();
};
