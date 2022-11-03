var baseUrl = window.location.origin;
const XhttpSession = () => {
  var csrfName = document.getElementById("txt_csrfname").getAttribute("name");
  var csrfHash = document.getElementById("txt_csrfname").value;

  const data = {};
  data["key"] = "reset_session";
  data[csrfName] = csrfHash;

  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", baseUrl + "/session-reset", true);
  xhttp.onreadystatechange = () => {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      var response = JSON.parse(xhttp.responseText);
      document.getElementById("txt_csrfname").value = response["value"];
      document.getElementById("txt_csrfname").name = response["name"];

      localStorage.clear();
      window.location.replace(baseUrl);
    }
  };
  xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
  xhttp.setRequestHeader("Content-Type", "application/json");
  xhttp.send(JSON.stringify(data));
};
const restartBtnHandle = () => {
  XhttpSession();
};
