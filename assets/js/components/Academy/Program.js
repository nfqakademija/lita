import React, {Fragment, PureComponent} from 'react';
import Tab from 'react-bootstrap/Tab';
import './academy.scss';
import PropTypes from "prop-types";
import Reviews from "../Reviews";

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
                            <div className="row justify-content-between">
                                <div className="col-md-8 pr-0 mt-5 mt-sm-0">
                                    <h3>{program.program_name}</h3>
                                    <p>{program.program_description}</p>
                                </div>

                                <div className="col-md-3 pr-0">
                                    <h5>Kaina: {this.renderProgramPriceBadge()} €</h5>
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-md-12">
                                    <div className="reviews">
                                        <h3 className="mt-5">Atsiliepimai</h3>
                                        <Reviews  reviews={program.program_reviews} programId={program.program_id}/>
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
