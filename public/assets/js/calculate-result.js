function calculateResult(tryout_quest) {
  var baseUrl = window.location.origin;
  var getSimulationData = localStorage.getItem(getSession);
  getSimulationData = getSimulationData ? JSON.parse(getSimulationData) : {};
  benar = 0;
  for (let i = 0; i < tryout_quest.length; i++) {
    if (getSimulationData[tryout_quest[i].id_soal]) {
      if (
        md5(getSimulationData[tryout_quest[i].id_soal]) ===
        tryout_quest[i].answare
      ) {
        benar++;
      }
    }
  }
  var result = ((benar * 10) / (tryout_quest.length * 10)) * 100;
  localStorage.removeItem(getSession);
  localStorage.setItem(getSession, result);
  window.location.replace(baseUrl + "/simulation-result");
}
