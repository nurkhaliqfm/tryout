var baseUrl = window.location.origin;
var timer = 300;
let current_page = 1;
let rows = 1;

const prev_button = document.getElementById("item_prev"),
  next_button = document.getElementById("item_next"),
  finish_button = document.getElementById("item_selesai"),
  question_num_btn = document.getElementById("question__number_side");

const getData = () => {
  var csrfName = document.getElementById("txt_csrfname").getAttribute("name");
  var csrfHash = document.getElementById("txt_csrfname").value;

  const data = {};
  data["key"] = "get_question";
  data[csrfName] = csrfHash;

  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", baseUrl + "/question-get", true);
  xhttp.onreadystatechange = () => {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      var response = JSON.parse(xhttp.responseText);
      document.getElementById("txt_csrfname").value = response["value"];
      document.getElementById("txt_csrfname").name = response["name"];

      let listQuest = response["question"];

      document.querySelector(".loader-container").style.display = "none";

      countdownTimer(timer, getSession);
      DisplayQuestion(listQuest, rows, current_page);
      NavBtnControl(current_page, listQuest);
      PaginationListNumber(listQuest, rows);
      ButtonPagination(listQuest);
    }
  };
  xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
  xhttp.setRequestHeader("Content-Type", "application/json");
  xhttp.send(JSON.stringify(data));
};

function CreateOption(question_id, id, value, label_option) {
  var radiobox = document.createElement("input");
  radiobox.type = "radio";
  radiobox.id = id;
  radiobox.value = value;
  radiobox.name = "flexRadioDefault";
  radiobox.className = "form-check-input";

  var label = document.createElement("label");
  label.htmlFor = id;
  label.className = "form-check-label";

  var descLabel = document.createTextNode(" " + label_option + ". ");
  var descText = document.createElement("span");
  descText.id = value;

  label.appendChild(descLabel);
  label.appendChild(descText);

  var newline = document.createElement("br");

  var container = document.getElementById(question_id);
  container.appendChild(radiobox);
  container.appendChild(label);
  container.appendChild(newline);
}

function SaveAnsware() {
  var UserQuizStorage = localStorage.getItem(getSession);
  UserQuizStorage = UserQuizStorage ? JSON.parse(UserQuizStorage) : {};

  document.querySelectorAll("input.form-check-input").forEach((itemOption) => {
    if (itemOption.checked) {
      var new_data = itemOption.value;
      var id_soal = document
        .getElementById("question__part")
        .getAttribute("id-soal");

      UserQuizStorage[id_soal] = new_data;

      localStorage.setItem(getSession, JSON.stringify(UserQuizStorage));
    }
  });
}

function DisplayQuestion(items, rows_per_page, page, csrfName, csrfHash) {
  page--;
  let start = rows_per_page * page;
  let end = start + rows_per_page;
  let paginatedItems = items.slice(start, end);

  var UserQuizStorage = localStorage.getItem(getSession);
  UserQuizStorage = UserQuizStorage ? JSON.parse(UserQuizStorage) : {};
  UserQuizStorage[csrfName] = csrfHash;
  localStorage.setItem(getSession, JSON.stringify(UserQuizStorage));

  for (let i = 0; i < paginatedItems.length; i++) {
    let item = paginatedItems[i];

    document.getElementById("question__number").innerHTML = page + 1;
    document.getElementById("question__part").innerHTML = item.soal;

    document
      .getElementById("question__part")
      .setAttribute("id-soal", item.id_soal);

    if (document.querySelectorAll("input.form-check-input").length == 0) {
      document
        .querySelectorAll(".container-option .form-check")
        .forEach((item) => {
          let labelOption = item.getAttribute("option-name");
          CreateOption(
            item.id,
            "option" + labelOption,
            "option_" + labelOption.toLowerCase(),
            labelOption
          );
        });
    }

    document
      .querySelectorAll("input.form-check-input")
      .forEach((itemOption) => {
        document.querySelector(
          'span[id="' + itemOption.value + '"]'
        ).innerHTML = item[itemOption.value];

        itemOption.checked = false;
        if (itemOption.value == UserQuizStorage[item.id_soal]) {
          itemOption.checked = true;
        }
      });
  }
}

function PaginationListNumber(items, row_per_page) {
  let page_count = Math.ceil(items.length / row_per_page);
  for (let i = 1; i < page_count + 1; i++) {
    let btn = BtnNumberPagination(i);
    question_num_btn.appendChild(btn);
  }
}

function BtnNumberPagination(page) {
  let btn__side = document.createElement("div");
  btn__side.className = "question-sidenum";
  btn__side.setAttribute("id-question", page);
  btn__side.innerHTML = page;

  if (current_page == page) {
    btn__side.classList.add("warning");
    btn__side.classList.add("active");
  }

  return btn__side;
}

function SidebarStatus(current_page) {
  document.querySelectorAll(".question-sidenum").forEach((el) => {
    el.classList.remove("active");
  });

  let selectedQuestion = document.querySelector(
    '.question-sidenum[id-question="' + current_page + '"]'
  );
  selectedQuestion.classList.add("active");
  selectedQuestion.classList.add("warning");

  document.querySelectorAll("input.form-check-input").forEach((itemOption) => {
    if (itemOption.checked) {
      selectedQuestion.classList.remove("warning");
      selectedQuestion.classList.add("done");
    }
  });
}

function ButtonPagination(tryout_quest) {
  SidebarStatus(current_page);
  document.querySelectorAll("input.form-check-input").forEach((itemOption) => {
    itemOption.addEventListener("click", () => {
      SaveAnsware();
      let selectedQuestion = document.querySelector(
        '.question-sidenum[id-question="' + current_page + '"]'
      );
      selectedQuestion.classList.remove("warning");
      selectedQuestion.classList.add("done");
    });
  });

  next_button.addEventListener("click", () => {
    current_page = current_page + 1;
    DisplayQuestion(tryout_quest, rows, current_page);
    NavBtnControl(current_page, tryout_quest);
    SidebarStatus(current_page, tryout_quest);
  });

  prev_button.addEventListener("click", () => {
    current_page = current_page - 1;
    DisplayQuestion(tryout_quest, rows, current_page);
    SidebarStatus(current_page, tryout_quest);
    NavBtnControl(current_page, tryout_quest);
  });

  finish_button.addEventListener("click", () => {
    var baseUrl = window.location.origin;
    window.location.replace(baseUrl + "/simulation-result");
  });

  document.querySelectorAll(".question-sidenum").forEach((element) => {
    element.addEventListener("click", () => {
      current_page = parseInt(element.getAttribute("id-question"));
      DisplayQuestion(tryout_quest, rows, current_page);
      NavBtnControl(current_page, tryout_quest);
      SidebarStatus(current_page, tryout_quest);
    });
  });
}

function NavBtnControl(current_page, tryout_quest) {
  if (current_page == 1) {
    prev_button.disabled = true;
  } else {
    prev_button.removeAttribute("disabled", "");
  }

  if (current_page == tryout_quest.length) {
    next_button.setAttribute("disabled", "");
    next_button.setAttribute("style", "display:none");
    finish_button.setAttribute("style", "display:");
    finish_button.disabled = false;
  } else {
    next_button.setAttribute("style", "display:");
    next_button.removeAttribute("disabled", "");
    finish_button.setAttribute("style", "display:none");
    finish_button.disabled = true;
  }
}
