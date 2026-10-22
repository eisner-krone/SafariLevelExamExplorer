<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocationGui\Communication\Controller;

use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\Antelope\Persistence\Exception\EntityNotFoundException;
use Pyz\Zed\AntelopeLocationGui\Communication\AntelopeLocationGuiCommunicationFactory;
use Pyz\Zed\AntelopeLocationGui\Communication\Form\AntelopeLocationCreateForm;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method AntelopeLocationGuiCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    protected const string URL_ANTELOPE_LOCATION_OVERVIEW = '/antelope-location-gui';

    protected const string PARAM_ID_ANTELOPE_LOCATION = 'id';

    protected const string MESSAGE_ANTELOPE_LOCATION_CREATED_SUCCESS = 'Antelope location was successfully created.';

    protected const string MESSAGE_ANTELOPE_LOCATION_UPDATED_SUCCESS = 'Antelope location was successfully updated.';

    protected const string MESSAGE_ANTELOPE_LOCATION_NOT_FOUND = 'Antelope location not found.';

    protected const string MESSAGE_ANTELOPE_LOCATION_NAME_TAKEN = 'A location with this name already exists.';

    /**
     * @return array<string,mixed>
     */
    public function indexAction(): array
    {
        $table = $this->getFactory()
            ->createAntelopeLocationTable();

        return $this->viewResponse([
            'antelopeLocationTable' => $table->render(),
        ]);
    }

    public function tableAction(): JsonResponse
    {
        $table = $this->getFactory()
            ->createAntelopeLocationTable();

        return $this->jsonResponse($table->fetchData());
    }

    /**
     * @param Request $request
     * @return RedirectResponse|array<string,mixed>
     */
    public function createAction(Request $request): RedirectResponse|array
    {
        $antelopeLocationCreateForm = $this->getFactory()
            ->createAntelopeLocationCreateForm(new AntelopeLocationTransfer())
            ->handleRequest($request);

        if ($antelopeLocationCreateForm->isSubmitted() && $antelopeLocationCreateForm->isValid()) {
            /** @var AntelopeLocationTransfer $antelopeLocationTransfer */
            $antelopeLocationTransfer = $antelopeLocationCreateForm->getData();

            if (!$this->isLocationNameTaken($antelopeLocationTransfer, $antelopeLocationCreateForm)) {
                $this->getFactory()
                    ->getAntelopeFacade()
                    ->createAntelopeLocation($antelopeLocationTransfer);

                $this->addSuccessMessage(static::MESSAGE_ANTELOPE_LOCATION_CREATED_SUCCESS);

                return $this->redirectResponse($this->getAntelopeLocationOverviewUrl());
            }
        }

        return $this->viewResponse([
            'antelopeLocationCreateForm' => $antelopeLocationCreateForm->createView(),
            'backUrl' => $this->getAntelopeLocationOverviewUrl(),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|array<string,mixed>
     */
    public function editAction(Request $request): RedirectResponse|array
    {
        $idAntelopeLocation = $this->castId($request->query->get(static::PARAM_ID_ANTELOPE_LOCATION));

        try {
            $antelopeLocationTransfer = $this->getFactory()
                ->getAntelopeFacade()
                ->getAntelopeLocationById($idAntelopeLocation);
        } catch (EntityNotFoundException $exception) {
            $this->addErrorMessage(static::MESSAGE_ANTELOPE_LOCATION_NOT_FOUND);

            return $this->redirectResponse($this->getAntelopeLocationOverviewUrl());
        }

        $antelopeLocationEditForm = $this->getFactory()
            ->createAntelopeLocationCreateForm($antelopeLocationTransfer)
            ->handleRequest($request);

        if ($antelopeLocationEditForm->isSubmitted() && $antelopeLocationEditForm->isValid()) {
            /** @var AntelopeLocationTransfer $antelopeLocationTransfer */
            $antelopeLocationTransfer = $antelopeLocationEditForm->getData();

            if (!$this->isLocationNameTaken($antelopeLocationTransfer, $antelopeLocationEditForm)) {
                $this->getFactory()
                    ->getAntelopeFacade()
                    ->updateAntelopeLocation($antelopeLocationTransfer);

                $this->addSuccessMessage(static::MESSAGE_ANTELOPE_LOCATION_UPDATED_SUCCESS);

                return $this->redirectResponse($this->getAntelopeLocationOverviewUrl());
            }
        }

        return $this->viewResponse([
            'antelopeLocationEditForm' => $antelopeLocationEditForm->createView(),
            'idAntelopeLocation' => $idAntelopeLocation,
            'backUrl' => $this->getAntelopeLocationOverviewUrl(),
        ]);
    }

    protected function isLocationNameTaken(
        AntelopeLocationTransfer $antelopeLocationTransfer,
        FormInterface $form
    ): bool {
        $antelopeLocationCriteriaTransfer = (new AntelopeLocationCriteriaTransfer())
            ->setLocationName($antelopeLocationTransfer->getLocationName());

        $antelopeLocationResponseTransfer = $this->getFactory()
            ->getAntelopeFacade()
            ->getAntelopeLocation($antelopeLocationCriteriaTransfer);

        if (!$antelopeLocationResponseTransfer->getIsSuccessful()) {
            return false;
        }

        $idExistingAntelopeLocation = $antelopeLocationResponseTransfer->getAntelopeLocation()->getIdAntelopeLocation();
        if ($idExistingAntelopeLocation === $antelopeLocationTransfer->getIdAntelopeLocation()) {
            return false;
        }

        $form->get(AntelopeLocationCreateForm::FIELD_LOCATION_NAME)
            ->addError(new FormError(static::MESSAGE_ANTELOPE_LOCATION_NAME_TAKEN));

        return true;
    }

    protected function getAntelopeLocationOverviewUrl(): string
    {
        return (string)Url::generate(static::URL_ANTELOPE_LOCATION_OVERVIEW);
    }
}
