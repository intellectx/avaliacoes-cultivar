import React, {useState} from 'react';
import {Button, Modal} from "@themesberg/react-bootstrap";
import {faQuestionCircle, faTrash} from "@fortawesome/free-solid-svg-icons";
import {lang} from "../../lang";
import {ButtonProps} from "./ButtonProps";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {useForm} from "@inertiajs/inertia-react";

export const DeleteButton: React.FunctionComponent<ButtonProps> = (props) => {
  const {
    to,
    tipText = lang('general.deleteTip')
  } = props;

  const { post } = useForm({});
  const [showConfirm, setShowConfirm] = useState(false);
  const handleClose = () => setShowConfirm(false);

  const onClickPositive = async (e: React.MouseEvent) => {
    await post(to);
    setShowConfirm(false);
  }

  return (
    <>
      <Button
        onClick={() => setShowConfirm(true)}
        title={tipText}
        variant="danger"
        size="sm"
        className="m-1"
      >
        <FontAwesomeIcon icon={faTrash} />
      </Button>

      <Modal as={Modal.Dialog} centered show={showConfirm} onHide={handleClose}>
        <Modal.Header>
          <Modal.Title className="h6">
            <FontAwesomeIcon icon={faQuestionCircle} /> Aplicação pergunta
          </Modal.Title>
          <Button variant="close" aria-label="Close" onClick={handleClose} />
        </Modal.Header>
        <Modal.Body>
          <p>Você deseja realmente <strong className="text-danger">EXCLUIR</strong> este registro?</p>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="link" className="text-gray ms-auto" onClick={handleClose}>
            Cancelar
          </Button>
          <Button variant="success" onClick={onClickPositive}>
            Sim
          </Button>
        </Modal.Footer>
      </Modal>
    </>
  );
}
