// 1. Set session flag when viewing legal products
document.addEventListener("DOMContentLoaded", () => {
    if (isLegalProductPage()) {
        sessionStorage.setItem("visitedLegalProduct", "true");
    }
});

// 2. Trigger survey when leaving legal product section
function shouldTriggerSurvey() {
    // Only trigger if:
    // a) User came from a legal product page
    // b) Current page is NOT a legal product
    // c) User has not already completed the survey
    // d) Survey form is exists
    return (
        sessionStorage.getItem("visitedLegalProduct") === "true" &&
        !isLegalProductPage() &&
        // sessionStorage.getItem("surveyCompleted") !== "true" &&
        $("#surveyPopup")?.length
    );
}

// 3. Show survey with exit detection
function initSurvey() {
    if (shouldTriggerSurvey()) {
        showSurveyModal();
    }

    handleFormSubmission();

    const btnId = "btnskm";
    const surveySubmit = document.getElementById(btnId);

    if (surveySubmit) {
        window.window[btnId] = Ladda.create(
            document.querySelector("#" + btnId)
        );
    }
}

// 4. Page type detection (customize based on your site)
function isLegalProductPage() {
    return (
        window.location.pathname.includes("/produk-hukum") ||
        window.location.pathname.includes("/propemperda")
    );
}

// 5. Modal display logic
function showSurveyModal() {
    $("#surveyPopup")?.modal?.("show");
}

// 6. Handle form submission
function handleFormSubmission() {
    const surveyForm = document.getElementById("formskm");
    if (surveyForm) {
        surveyForm.addEventListener("submit", (event) => {
            event.preventDefault();
            // This logic is on /public/assets/js/pact.js line 195
            option = {
                module: "skm",
                success: {
                    request: "surveyThanks",
                },
            };
            sentData("/api/skm", option);
        });
    }
}

// 7. Run on page load and history changes
// Add slight delay for better UX
setTimeout(initSurvey, 1500);
window.addEventListener("popstate", initSurvey);
