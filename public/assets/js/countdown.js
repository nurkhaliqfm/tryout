class Timer {
  constructor(root, timer, getSession) {
    root.innerHTML = Timer.getHTML();

    this.el = {
      minutes: root.querySelector(".timer__countdown__minute"),
      seconds: root.querySelector(".timer__countdown__second"),
    };

    var UserQuizStorage = localStorage.getItem(getSession);
    UserQuizStorage = UserQuizStorage ? JSON.parse(UserQuizStorage) : {};

    if (UserQuizStorage["time"] == null) {
      this.setTimer = timer;
    } else {
      this.setTimer = UserQuizStorage["time"];
    }

    this.interval = null;
    this.remainingSeconds = this.setTimer;
    this.updateInterfaceTime();

    if (this.interval === null) {
      this.start();
    } else {
      this.stop();
    }
  }

  updateInterfaceTime() {
    const minutes = Math.floor(this.remainingSeconds / 60);
    const seconds = this.remainingSeconds % 60;

    this.el.minutes.textContent = minutes.toString().padStart(2, "0");
    this.el.seconds.textContent = seconds.toString().padStart(2, "0");
  }

  start() {
    if (this.remainingSeconds === 0) return;

    this.interval = setInterval(() => {
      this.remainingSeconds--;
      this.updateInterfaceTime();

      var UserQuizStorage = localStorage.getItem(getSession);
      UserQuizStorage = UserQuizStorage ? JSON.parse(UserQuizStorage) : {};
      UserQuizStorage["time"] = this.remainingSeconds;
      localStorage.setItem(getSession, JSON.stringify(UserQuizStorage));

      if (this.remainingSeconds === 0) {
        this.stop();
        delete UserQuizStorage.time;
        localStorage.setItem(getSession, JSON.stringify(UserQuizStorage));
      }
    }, 1000);
  }

  stop() {
    clearInterval(this.interval);
    this.interval = null;

    var baseUrl = window.location.origin;
    window.location.replace(baseUrl + "/simulation-result");
  }

  static getHTML() {
    return `
              <span><i class="fa-solid fa-clock"></i></span>
              <span class="timer__countdown__minute">00</span>
              <span>:</span>
              <span class="timer__countdown__second">00</span>
          `;
  }
}

function countdownTimer(timer, session_id) {
  new Timer(document.querySelector(".timer__countdown"), timer, session_id);
}
