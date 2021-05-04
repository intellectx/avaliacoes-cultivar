import React from 'react';
import {Button} from "@themesberg/react-bootstrap";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faTrash} from "@fortawesome/free-solid-svg-icons";
import {lang} from "../../lang";
import {InertiaLink} from "@inertiajs/inertia-react";
import {EditButtonProps} from "./ButtonProps";

const DeleteButton: React.FunctionComponent<EditButtonProps> = (props) => {
  const {
    to,
    tipText = lang('general.deleteTip')
  } = props;

  return (
    <Button
      as={InertiaLink}
      href={to}
      title={tipText}
      method='delete'
      variant="danger"
      size="sm"
      className="m-1"
    >
      <FontAwesomeIcon icon={faTrash} />
    </Button>
  );
}

export default DeleteButton;
