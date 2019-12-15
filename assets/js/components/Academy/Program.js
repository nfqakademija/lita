import React, {Fragment, PureComponent} from 'react';
import Tab from 'react-bootstrap/Tab';
import './academy.scss';
import PropTypes from "prop-types";
import {Link} from "react-router-dom";

class Program extends PureComponent {
    renderProgramPriceBadge = () => {
        const { program } = this.props;
        let badgeColor = 'primary';

        if (program.program_price === 0) badgeColor = 'success';
        else if (program.program_price === null) badgeColor = 'info';

        return (<span className={`badge badge-${badgeColor}`}>{program.program_price}</span>)
    };

    render() {
        const { program, open, contentKey } = this.props;

        return (
            <Fragment>
                <Tab.Pane eventKey={contentKey}>
                        <div
                            id={`tab${program.program_id}`}
                            className={`tab-pane ${open ? 'active' : ''}`}
                        >
                            <div className="row justify-content-between h-100">
                                <div className="col-md-8 pr-0">
                                    <h3>{program.program_name}</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Nam viverra euismod odio, gravida pellentesque urna varius vitae.
                                        Sed dui lorem, adipiscing in adipiscing et, interdum nec metus.
                                        Mauris ultricies, justo eu convallis placerat, felis enim.
                                    </p>
                                </div>

                                <div className="col-md-3 pr-0">
                                    <ul>
                                        <li><h4>Kaina: {this.renderProgramPriceBadge()}</h4></li>
                                    </ul>
                                </div>

                                {/*<div className="col-md-9">*/}
                                {/*    <h3 className="mb-5">Cities & Date</h3>*/}
                                {/*    <div id="accordion">*/}
                                {/*        <div className="card">*/}
                                {/*            <div className="card-header the-blue" id="headingOne">*/}
                                {/*                <h5 className="mb-0">*/}
                                {/*                    <button className="btn btn-link collapsed" data-toggle="collapse"*/}
                                {/*                            data-target="#collapseOne" aria-expanded="false"*/}
                                {/*                            aria-controls="collapseOne">*/}
                                {/*                        Vilnius*/}
                                {/*                    </button>*/}
                                {/*                </h5>*/}
                                {/*            </div>*/}
                                {/*            <div id="collapseOne" className="collapse" aria-labelledby="headingOne"*/}
                                {/*                 data-parent="#accordion">*/}
                                {/*                <div className="card-body">*/}
                                {/*                    <p>gruodžio 4 d. – vasario 14 d.</p>*/}
                                {/*                    <p>gruodžio 4 d. – vasario 14 d.</p>*/}
                                {/*                    <p>gruodžio 4 d. – vasario 14 d.</p>*/}
                                {/*                </div>*/}
                                {/*            </div>*/}
                                {/*        </div>*/}
                                {/*        <div className="card">*/}
                                {/*            <div className="card-header the-blue" id="headingTwo">*/}
                                {/*                <h5 className="mb-0">*/}
                                {/*                    <button className="btn btn-link collapsed" data-toggle="collapse"*/}
                                {/*                            data-target="#collapseTwo" aria-expanded="false"*/}
                                {/*                            aria-controls="collapseTwo">*/}
                                {/*                        Kaunas*/}
                                {/*                    </button>*/}
                                {/*                </h5>*/}
                                {/*            </div>*/}
                                {/*            <div id="collapseTwo" className="collapse" aria-labelledby="headingTwo"*/}
                                {/*                 data-parent="#accordion">*/}
                                {/*                <div className="card-body">*/}
                                {/*                    <p>gruodžio 4 d. – vasario 14 d.</p>*/}
                                {/*                </div>*/}
                                {/*            </div>*/}
                                {/*        </div>*/}
                                {/*        <div className="card">*/}
                                {/*            <div className="card-header the-blue" id="headingThree">*/}
                                {/*                <h5 className="mb-0">*/}
                                {/*                    <button className="btn btn-link collapsed" data-toggle="collapse"*/}
                                {/*                            data-target="#collapseThree" aria-expanded="false"*/}
                                {/*                            aria-controls="collapseThree">*/}
                                {/*                        Klaipėda*/}
                                {/*                    </button>*/}
                                {/*                </h5>*/}
                                {/*            </div>*/}
                                {/*            <div id="collapseThree" className="collapse" aria-labelledby="headingThree"*/}
                                {/*                 data-parent="#accordion">*/}
                                {/*                <div className="card-body">*/}
                                {/*                    <p>gruodžio 4 d. – vasario 14 d.</p>*/}
                                {/*                    <p>gruodžio 4 d. – vasario 14 d.</p>*/}
                                {/*                </div>*/}
                                {/*            </div>*/}
                                {/*        </div>*/}
                                {/*    </div>*/}
                                {/*</div>*/}
                                <div className="col-md-9">
                                    <div className="reviews">
                                        <h3 className="mt-5">Reviews</h3>

                                    </div>
                                </div>
                            </div>
                        </div>
                </Tab.Pane>
            </Fragment>
        );
    }
}

Program.propTypes = {
    program: PropTypes.object,
    contentKey: PropTypes.number,
    open: PropTypes.bool
};

export default Program;
