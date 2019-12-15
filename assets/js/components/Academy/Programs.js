import React, {Component} from 'react';
import Tab from 'react-bootstrap/Tab';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Nav from 'react-bootstrap/Nav';
import PropTypes from "prop-types";
import Program from "./Program";

class Programs extends Component {
    getDefaultProgram = () => {
        const { preferableProgram, programs } = this.props;

        if (preferableProgram !== '') {
            const openProgram = programs.find(program => program.program_name === preferableProgram);
            return openProgram.program_id;
        } else {
            return programs[0].program_id;
        }

    }
    render() {
        const { programs } = this.props;

        return (
            <Tab.Container id="left-tabs-example" defaultActiveKey={this.getDefaultProgram()}>
                <Row>
                    <Col sm={3}>
                        <Nav variant="pills" className="flex-column">
                            {programs.map((program) => (
                                <Nav.Item key={program.program_id}>
                                    <Nav.Link eventKey={program.program_id}>{program.program_name}</Nav.Link>
                                </Nav.Item>
                            ))}
                        </Nav>
                    </Col>
                    <Col sm={9}>
                        <Tab.Content>
                            {programs.map((program, index) => (
                                    <Program
                                        key={program.program_id}
                                        contentKey={program.program_id}
                                        program={program}
                                        open={index === 0}
                                    />
                                )
                            )}
                        </Tab.Content>
                    </Col>
                </Row>
            </Tab.Container>
        );
    }
}

Programs.propTypes = {
    programs: PropTypes.array,
    preferableProgram: PropTypes.string
};

export default Programs;
