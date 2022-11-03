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

      let session = response["session_id"];
      localStorage.setItem("session_id", JSON.stringify(session));
      window.location.replace(baseUrl + "/online-simulation");
    }
  };
  xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
  xhttp.setRequestHeader("Content-Type", "application/json");
  xhttp.send(JSON.stringify(data));
};
const goBtnHandle = () => {
  XhttpSession();
};
