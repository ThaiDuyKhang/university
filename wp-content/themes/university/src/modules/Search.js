import $ from "jquery";

class Search {
  //1
  constructor() {
    this.addSearchHTML();
    this.resultsDiv = $("#search-overlay__results");
    this.openBtn = $(".js-search-trigger");
    this.closeBtn = $(".search-overlay__close");
    this.searchOverlay = $(".search-overlay");
    this.searchField = $("#search-term");
    this.isSpinnerVisible = false;
    this.isOverlayOpen = false;
    this.previousValue;
    this.typingTimer;
    this.events();
  }
  //2 Events
  events() {
    this.openBtn.on("click", this.openOverlay.bind(this));
    this.closeBtn.on("click", this.closeOverlay.bind(this));
    $(document).on("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.on("keyup", this.typingLogic.bind(this));
  }

  //3
  typingLogic() {
    if (this.searchField.val() != this.previousValue) {
      clearTimeout(this.typingTimer);

      if (this.searchField.val()) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 0);
      } else {
        this.resultsDiv.html("");
        this.isSpinnerVisible = false;
      }
    }
    this.previousValue = this.searchField.val();
  }

  getResults() {
    $.getJSON(
      universityData.root_url +
        "/wp-json/university/v1/search?term=" +
        this.searchField.val(),
      (results) => {
        this.resultsDiv.html(`
          <div class=="row">
            <div class="one-third">
            <h2 class="search-overlay__section-title">General Info</h2>
              ${
                results.generalInfo.length
                  ? '<ul class="link-list min-list">'
                  : " "
              }
              ${results.generalInfo
                .map((item) => {
                  return `            
                  <li>
                    <a href="${item.permalink}">${item.title}</a> ${
                      item.postType == "post" ? `by ${item.authorName}` : ""
                    }
                  </li>`;
                })
                .join("")}
              ${results.generalInfo.length ? "</ul>" : ""}
            </div>
            <div class="one-third">
              <h2 class="search-overlay__section-title">Programs</h2>
              ${
                results.programs.length
                  ? '<ul class="link-list min-list">'
                  : `<p>Không có chương trình học nào trong tìm tiếm. <a href="${universityData.root_url}/programs">Xem tất cả chương trình học</a></p>`
              }
              ${results.programs
                .map((item) => {
                  return `            
                  <li>
                    <a href="${item.permalink}">${item.title}</a> ${
                      item.postType == "post" ? `by ${item.authorName}` : ""
                    }
                  </li>`;
                })
                .join("")}
              ${results.programs.length ? "</ul>" : ""}
              
              <h2 class="search-overlay__section-title">Professors</h2>
              ${
                results.professors.length
                  ? '<ul class="professor-cards">'
                  : `<p>Không có giảng viên nào trong tìm tiếm. <a href="${universityData.root_url}/professor">Xem tất cả giảng viên</a></p>`
              }
              ${results.professors
                .map((item) => {
                  return `            
                <li class="professor-card__list-item">
                    <a class="professor-card" href="${item.permalink}">
                        <img class="professor-card__image" src="${item.avatar}" />
                        <span class="professor-card__name">${item.title}</span>
                    </a>
                </li>
                  `;
                })
                .join("")}
              ${results.professors.length ? "</ul>" : ""}  
            </div>
            <div class="one-third">
              <h2 class="search-overlay__section-title">Campuses</h2>
              ${
                results.campuses.length
                  ? '<ul class="link-list min-list">'
                  : `<p>Không có cơ sở nào trong tìm tiếm. <a href="${universityData.root_url}/campuses">Xem tất cả cơ sở</a></p>`
              }
              ${results.campuses
                .map((item) => {
                  return `            
                  <li>
                    <a href="${item.permalink}">${item.title}</a> ${
                      item.postType == "post" ? `by ${item.authorName}` : ""
                    }
                  </li>`;
                })
                .join("")}
              ${results.campuses.length ? "</ul>" : ""} 

              <h2 class="search-overlay__section-title">Events</h2>
              ${
                results.events.length
                  ? '<ul class="link-list min-list">'
                  : `<p>Không có sự kiện nào trong tìm tiếm. <a href="${universityData.root_url}/events">Xem tất cả sự kiện</a></p>`
              }
              ${results.events
                .map((item) => {
                  return `            
                <div class="event-summary">
                <a class="event-summary__date t-center" href="${item.permalink}">
                    <span class="event-summary__month">
                        ${item.month}
                    </span>
                    <span class="event-summary__day">
                        ${item.day}
                    </span>
                </a>
                
                <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
                    <p style="margin-bottom:10px">${item.description}</p>
                </div>
            </div>
                  `;
                })
                .join("")}
              ${results.events.length ? "</ul>" : ""} 
            </div>
          </div>
        `);
        this.isSpinnerVisible = false;
      }
    );
  }

  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
    this.searchField.val("");
    setTimeout(() => this.searchField.focus(), 200);
    console.log("our open method just ran!")
    this.isOverlayOpen = true;
    return false;
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    this.isOverlayOpen = false;
  }

  keyPressDispatcher(e) {
    console.log(e.keyCode);
    if (
      e.keyCode == 38 &&
      !this.isOverlayOpen &&
      !$("input, textarea").is(":focus")
    ) {
      this.openOverlay();
    }
    if (e.keyCode == 40 && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

  addSearchHTML() {
    $("body").append(
      `<div class="search-overlay">
        <div class="search-overlay__top">
              <div class="container">
                  <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
                  <input type="text" class="search-term" placeholder="Nhập từ khoá bạn cần tìm..." id="search-term" autocomplete="off">
                  <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
              </div>
          </div>
          <div class="container">
              <div id="search-overlay__results">
              </div>
        </div>
      </div>`
    );
  }
}

export default Search;
