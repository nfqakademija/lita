import React, { PureComponent } from 'react';
import './academy.scss';
import PropTypes from "prop-types";

class Program extends PureComponent {
    renderProgramPriceBadge = () => {
        const { program } = this.props;
        let badgeColor = 'primary';

        if (program.program_price === 0) badgeColor = 'success';
        else if (program.program_price === null) badgeColor = 'info';

        return (<span className={`badge badge-${badgeColor}`}>{program.program_price}</span>)
    };

    render() {
        const { program, open } = this.props;
        return (
            <div className="card">
                <div
                    className="card-header"
                    id={`heading${program.program_id}`}
                    data-toggle="collapse"
                    data-target={`#collapse${program.program_id}`}
                    aria-expanded={`${open ? 'true' : 'false'}`}
                    aria-controls={`collapse${program.program_id}`}
                >
                    <h2 className="mb-0">
                        <button
                            className={`btn btn-link ${open ? '' : 'collapsed'}`}
                            type="button"
                        >
                            {program.program_name}
                        </button>
                    </h2>
                </div>

                <div
                    id={`collapse${program.program_id}`}
                    className={`collapse ${open ? 'show' : ''}`}
                    aria-labelledby={`heading${program.program_id}`}
                    data-parent="#programs"
                >
                    <div className="card-body">
                        <h4>Kaina: {this.renderProgramPriceBadge()}</h4>
                    </div>
                </div>
            </div>
        );
    }
}

Program.propTypes = {
    program: PropTypes.object,
    open: PropTypes.bool
};

export default Program;
