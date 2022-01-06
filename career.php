<?php include_once('header.php'); ?>
<style>
    ul.job-desc{
        margin-top:0px !important;
    }
    ul.job-desc li{padding:5px 6px !important;font-size: 14px;
    font-weight: 600;}
    ul.job-desc li::before {
   content:  "\2713 ";
   padding-right:10px;
}
p.icon-p{
    font-size: 14px !important;;
    line-height: 2;
}
@media only screen and (max-width: 480px){
    p.icon-p{
    font-size: 12px !important;
    line-height: 2;
}
    
}
</style>
<div class="inner-page">
    <div class="careerSlide slider-item overlay">
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
                <div class="col-lg-9 text-center col-sm-12 element-animate">
                    <h1 class="mb-4">Career</h1>
                    <p class="custom-breadcrumbs"><a href="/">Home</a> <span class="mx-3">/</span> Career</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section" style="padding-bottom:4em">
    <div class="container">
        <div class="row">
            <div class="col-md-12 job-title">
                <p>We have very few openings. Why? Two reasons. First – higher than industry retention rate that you can read about on our Lifestyle page. Second – we believe in tribe theory and the current tribe of 100-110 colleagues allows us to be very selective in who we let in the tribe. It also reduces sales pressure and we work with people and projects that excite us.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 filter">
                <div class="filter-fixed">
                    <h3>Filters</h3>
                    <form action="javascript:void(0)" class="searchandfilter" onchange="Career.filterSelection(this)">
                        <ul id="filter">
                            <li data-sf-field-input-type="checkbox"><h4>Sector</h4>
                            <li class="sf-level-0 sf-item-21">
                                <input checked class="sf-input-checkbox" id="content-writing" name="sector" type="checkbox" value="content-writing">
                                <label class="sf-label-checkbox" for="content-writing">Content Writing</label>
                            </li>
                            <li class="sf-level-0 sf-item-21">
                                <input checked class="sf-input-checkbox" id="legal-advisor" name="sector" type="checkbox" value="legal-advisor">
                                <label class="sf-label-checkbox" for="legal-advisor">Legal Advisor</label>
                                
                            </li>
                            <li class="sf-level-0 sf-item-21">
                                <input checked class="sf-input-checkbox" id="product-manager" name="sector" type="checkbox" value="product-manager">
                                <label class="sf-label-checkbox" for="product-manager">Product Manager</label>
                            </li>
                            <li class="sf-level-0 sf-item-21">
                                <input checked class="sf-input-checkbox" id="quality-assurance" name="sector" type="checkbox" value="quality-assurance">
                                <label class="sf-label-checkbox" for="quality-assurance">Quality Assurance</label>
                            </li>
                            <li class="sf-level-0 sf-item-21">
                                <input checked class="sf-input-checkbox" id="software-development" name="sector" type="checkbox" value="software-development">
                                <label class="sf-label-checkbox" for="software-development">Software Development</label>
                            </li>
                            <li class="sf-level-0 sf-item-21">
                                <input checked class="sf-input-checkbox" id="technical-analyst" name="sector" type="checkbox" value="technical-analyst">
                                <label class="sf-label-checkbox" for="technical-analyst">Technical Analyst</label>
                            </li>
                            <li class="sf-level-0 sf-item-21">
                                <input checked class="sf-input-checkbox" id="ux-graphics" name="sector" type="checkbox" value="ux-graphics">
                                <label class="sf-label-checkbox" for="ux-graphics">UX / Graphics</label>
                                
                            </li>
                            
                        </ul>
                    </form>
                </div>
            </div>
            <div class="col-md-9 job-description">
                <div class="jobs-detail-loop">
                    <div class="detail-loop Full times">
                        <div class="desc">
                            <div id="integration-list">
                                <ul id="job-postings">
                                    <li>
                                        <a class="expand">
                                            <div class="right-arrow">+</div>
                                            <div>
                                                <h2 id="job-title"> Legal Advisor</h2>
                                                <p class="icon-p">
                                                    <i class="fa fa-money"></i> Market Competitive &nbsp; | 
                                                    <i class="fa fa-map-marker"></i> Karachi &nbsp; | 
                                                    <i class="fa fa-clock-o"></i> Full time </p>
                                                <div class="keys">
                                                    <p>As a legal advisor, you will be responsible for handling a company’s legal responsibilities. Duties may include preparing contracts and documentation, and providing a variety of legal support.
The role of a legal advisor in the construction industry involves the following duties: .</p>
                                                     <ul class="job-desc">
                                                         <li>Overseeing client and vendor contracts</li>
                                                         <li>Providing commercially sensible and cost-effective legal advice for contracts management</li>
                                                         <li>Conducting legal research</li>
                                                         <li>Ensuring compliance to laws and regulations</li>
                                                         <li>Preparing damage claims</li>
                                                         <li>Resolving disputes/ clashes with other firms</li>
                                                         <li>Providing arbitration, litigation and mediation support</li>
                                                         <li>Advising on the latest quality standards</li>
                                                         <li>Overseeing health and safety and claims and offering advice on court cases</li>
                                                         <li>Meeting and interviewing clients</li>
                                                         <li>Drafting documents, letters and contracts</li>
                                                         <li>Acting on behalf of clients in disputes, if necessary.</li>
                                                     </ul>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="detail">
                                            <div id="right" style="width:100%;float:left;height:100%;">
                                                <div id="sup">
                                                    <div>
                                                        <a class="btn btn-shutter-more text-uppercase bg_blue" data-target="#exampleModalCenter" data-toggle="modal" href="javascript:void(0)" onclick="Career.fillJobForm(this)">Apply</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div aria-hidden="true" aria-labelledby="exampleModalCenterTitle" class="modal fade" id="exampleModalCenter" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-image: linear-gradient(to top right, #f15a24 50% , rgb(241, 90, 36, 0.6))!important;">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Node JS Developer</h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 col-sm-12 contact_form full_width_100" data-aos="fade-up">
                    <div class="inner_contact_row">
                        <img class="logo" src="./assets/images/footer-logo.png">
                        <br>
                        <br>
                        <form class="contact" onsubmit="Career.applyForJob(event, this)">
                            <div class="col-sm-6">
                                <input name="full_name" id="job-application-full-name" placeholder="Your Full Name" type="text" required>
                                <label for="job-application-full-name"></label>
                            </div>
                            <div class="col-sm-6">
                                <input name="email" id="job-application-email" placeholder="Your Email" type="email" required>
                                <label for="job-application-email"></label>
                            </div>
                            <div class="col-sm-6">
                                <input name="contact" id="job-application-contact" placeholder="Your Contact Number" type="number" required>
                                <label for="job-application-contact"></label>
                            </div>
                            <div class="col-sm-6">
                                <p id="job-application-job-role"></p>
                                <label for="job-application-job-role"></label>
                            </div>
                            <div class="col-sm-12">
                                <textarea name="message" id="job-application-message" placeholder="Your Message"></textarea>
                                <label for="job-application-message"></label>
                            </div>
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="btn w-50">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    class Career {
        static selectedJob;
        static jobPostings = document.querySelector('#job-postings');
        static applyForJobModal = document.querySelector('div[id="exampleModalCenter"]');
        static jobPositionCategories = {
            'content-writing': [],
            'product-manager': [],
            'quality-assurance': [],
            'legal-advisor': [
                `
                     <li>
                                        <a class="expand">
                                            <div class="right-arrow">+</div>
                                            <div>
                                                <h2 id="job-title"> Legal Advisor</h2>
                                                <p>
                                                    <i class="fa fa-money"></i> Market Competitive &nbsp; | &nbsp;
                                                    <i class="fa fa-map-marker"></i> Karachi &nbsp; | &nbsp;
                                                    <i class="fa fa-clock-o"></i> Full time </p>
                                                <div class="keys">
                                                    <p>As a legal advisor, you will be responsible for handling a company’s legal responsibilities. Duties may include preparing contracts and documentation, and providing a variety of legal support.
The role of a legal advisor in the construction industry involves the following duties: .</p>
                                                     <ul class="job-desc">
                                                         <li>Overseeing client and vendor contracts</li>
                                                         <li>Providing commercially sensible and cost-effective legal advice for contracts management</li>
                                                         <li>Conducting legal research</li>
                                                         <li>Ensuring compliance to laws and regulations</li>
                                                         <li>Preparing damage claims</li>
                                                         <li>Resolving disputes/ clashes with other firms</li>
                                                         <li>Providing arbitration, litigation and mediation support</li>
                                                         <li>Advising on the latest quality standards</li>
                                                         <li>Overseeing health and safety and claims and offering advice on court cases</li>
                                                         <li>Meeting and interviewing clients</li>
                                                         <li>Drafting documents, letters and contracts</li>
                                                         <li>Acting on behalf of clients in disputes, if necessary.</li>
                                                     </ul>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="detail">
                                            <div id="right" style="width:100%;float:left;height:100%;">
                                                <div id="sup">
                                                    <div>
                                                        <a class="btn btn-shutter-more text-uppercase bg_blue" data-target="#exampleModalCenter" data-toggle="modal" href="javascript:void(0)" onclick="Career.fillJobForm(this)">Apply</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                `
            ],
            'technical-analyst': [],
            'ux-graphics': [],
        };

        static filterSelection(formElement) {
            Career.jobPostings.innerHTML = Array.from(formElement.querySelectorAll('input')).filter(input => input.checked).map(input => Career.jobPositionCategories[input.id]).flat(Infinity).join('');
            Career.makeAccordionWork();
        }

        static fillJobForm(applyButton) {

            const heading = applyButton.closest('li').querySelector('#job-title').innerText;
            Career.selectedJob = heading;
            Career.applyForJobModal.querySelector('h5[id="exampleModalLongTitle"]').innerText = heading;
            Career.applyForJobModal.querySelector('p[id="job-application-job-role"]').innerText = heading;
        }

        static applyForJob(event, formElement) {

            event.preventDefault();
            const body = new FormData(formElement);
            body.append('job_role', Career.selectedJob);

            Career.selectedJob = undefined;

            fetch('/* URL comes here */', { method: 'POST', body })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    }

                    throw new Error('Something went wrong. Please try again!');
                })
                .then(response => {
                    if (response.status === 200) {
                        const responseText = response.body;
                        console.log(responseText);
                    }

                    else {
                        console.log(response, response.body);
                        alert(1);
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }

        static makeAccordionWork() {
            $(".expand").on("click", function () {
                $(this).next().slideToggle(400);
                const $expand = $(this).find(">:first-child");

                if ($expand.text() === "+") {
                    $expand.text("-");
                } else {
                    $expand.text("+");
                }
            });
        }
    }

    Career.makeAccordionWork();
</script>

<?php include_once('footer.php'); ?>