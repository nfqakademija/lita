import React, { Component } from 'react';
import PropTypes from "prop-types";
import Program from "./Program";

class Programs extends Component {
    render() {
        const { programs } = this.props;
        console.log(programs);
        return (
            <div className="accordion" id="programs">
                {programs.map((program, index) => (
                    <Program
                        key={program.program_id}
                        program={program}
                        open={index === 0}
                    />
                        )
                )}
            </div>
        );
    }
}

Programs.propTypes = {
    programs: PropTypes.array
};

export default Programs;
