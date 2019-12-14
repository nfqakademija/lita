import React, {Component, Fragment} from 'react';
import PropTypes from "prop-types";
import Program from "./Program";

class Programs extends Component {
    render() {
        const { programs } = this.props;
        console.log(programs);
        return (
            <Fragment id="programs">
                {programs.map((program, index) => (
                    <Program
                        key={program.program_id}
                        program={program}
                        open={index === 0}
                    />
                        )
                )}
            </Fragment>
        );
    }
}

Programs.propTypes = {
    programs: PropTypes.array
};

export default Programs;
