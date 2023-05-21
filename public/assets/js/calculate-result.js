const calculateResult = (tryout_quest, getSimulationResult) => {
  if (!getSimulationResult["result"]) {
    point = 0;
    for (let i = 0; i < tryout_quest.length; i++) {
      if (getSimulationResult[tryout_quest[i].id_soal]) {
        console.log();
        if (
          md5(getSimulationResult[tryout_quest[i].id_soal]) ===
          tryout_quest[i].answare
        ) {
          if (tryout_quest[i].value == "1") {
            point = point + 6;
          } else if (tryout_quest[i].value == "2") {
            point = point + 10;
          } else if (tryout_quest[i].value == "3") {
            point = point + 15;
          }
        } else if (
          md5(getSimulationResult[tryout_quest[i].id_soal]) !=
          tryout_quest[i].answare
        ) {
          if (tryout_quest[i].value == "1") {
            point = point - 4;
          } else if (tryout_quest[i].value == "2") {
            point = point - 7;
          } else if (tryout_quest[i].value == "3") {
            point = point - 10;
          }
        }
      }
    }
    var result = point;
    localStorage.removeItem(getSession);

    getSimulationResult["result"] = result;
    localStorage.setItem(getSession, JSON.stringify(getSimulationResult));
  }

  document.querySelector(".loader-container").style.display = "none";
  XhttpResultData(getSimulationResult["result"]);
  document.querySelector(".score").innerHTML = getSimulationResult["result"];
};

const XhttpResultData = (result_score) => {
  var csrfName = document.getElementById("txt_csrfname").getAttribute("name");
  var csrfHash = document.getElementById("txt_csrfname").value;

  const data = {};
  data["key"] = "save_result";
  data[csrfName] = csrfHash;
  data["result"] = result_score;

  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", baseUrl + "/save-result", true);
  xhttp.onreadystatechange = () => {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      var response = JSON.parse(xhttp.responseText);
      document.getElementById("txt_csrfname").value = response["value"];
      document.getElementById("txt_csrfname").name = response["name"];
    }
  };
  xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
  xhttp.setRequestHeader("Content-Type", "application/json");
  xhttp.send(JSON.stringify(data));
};
