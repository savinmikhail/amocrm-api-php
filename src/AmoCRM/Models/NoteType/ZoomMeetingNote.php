<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\AmoCRM\Models\Factories\NoteFactory;
use AmoCRM\Models\NoteModel;

class ZoomMeetingNote extends NoteModel
{
    protected $modelClass = ZoomMeetingNote::class;

    /**
     * @var null|array
     */
    protected $conference;

    /**
     * @var null|array
     */
    protected $recordings;

    public function getNoteType(): string
    {
        return NoteFactory::NOTE_TYPE_CODE_ZOOM_MEETING;
    }

    /**
     * @param array $note
     *
     * @return self
     */
    public function fromArray(array $note): NoteModel
    {
        $model = parent::fromArray($note);

        if (isset($note['params']['recordings'])) {
            $this->setRecordings($note['params']['recordings']);
        }

        if (isset($note['params']['conference'])) {
            $this->setConference($note['params']['conference']);
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        $result = parent::toArray();

        $result['params']['conference'] = $this->getConference();
        $result['params']['recordings'] = $this->getRecordings();

        return $result;
    }

    /**
     * @param int|null $requestId
     * @return array
     */
    public function toApi(int $requestId = null): array
    {
        $result = parent::toApi($requestId);

        $result['params']['conference'] = $this->getConference();
        $result['params']['recordings'] = $this->getRecordings();

        return $result;
    }

    /**
     * @return array|null
     */
    public function getConference(): ?array
    {
        return $this->conference;
    }

    /**
     * @param array|null $conference
     * @return ZoomMeetingNote
     */
    public function setConference(?array $conference): ZoomMeetingNote
    {
        $this->conference = $conference;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getRecordings(): ?array
    {
        return $this->recordings;
    }

    /**
     * @param array|null $recordings
     * @return ZoomMeetingNote
     */
    public function setRecordings(?array $recordings): ZoomMeetingNote
    {
        $this->recordings = $recordings;

        return $this;
    }
}