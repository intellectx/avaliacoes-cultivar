import React from 'react';
import {Button} from "@themesberg/react-bootstrap";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faPencilAlt} from "@fortawesome/free-solid-svg-icons";
import {lang} from "../../lang";
import {InertiaLink} from "@inertiajs/inertia-react";
import {EditButtonProps} from "./ButtonProps";

const EditButton: React.FunctionComponent<EditButtonProps> = (props) => {
  const {
    to,
    tipText = lang('general.editTip')
  } = props;

  return (
      <Button
        as={InertiaLink}
        href={to}
        title={tipText}
        variant="gray"
        size="sm"
        className="m-1"
      >
        <FontAwesomeIcon icon={faPencilAlt} />
      </Button>
  );
}

export default EditButton;
