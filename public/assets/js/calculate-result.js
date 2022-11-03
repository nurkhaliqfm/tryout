function calculateResult(tryout_quest, getSimulationResult) {
  if (!getSimulationResult["result"]) {
    benar = 0;
    for (let i = 0; i < tryout_quest.length; i++) {
      if (getSimulationResult[tryout_quest[i].id_soal]) {
        if (
          md5(getSimulationResult[tryout_quest[i].id_soal]) ===
          tryout_quest[i].answare
        ) {
          benar++;
        }
      }
    }
    var result = ((benar * 10) / (tryout_quest.length * 10)) * 100;
    localStorage.removeItem(getSession);

    getSimulationResult["result"] = result;
    localStorage.setItem(getSession, JSON.stringify(getSimulationResult));
  }

  document.querySelector(".loader-container").style.display = "none";
  document.querySelector(".score").innerHTML = getSimulationResult["result"];
}
